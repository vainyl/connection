<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Connection
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Connection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class ConnectionExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [[new ConnectionCompilerPass()]];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        $configuration = new ConnectionConfiguration();
        $connections = $this->processConfiguration($configuration, $configs);

        foreach ($connections as $name => $config) {
            $factoryId = 'connection.factory.' . $config['driver'];
            $definition = (new Definition())
                ->setClass(ConnectionInterface::class)
                ->setFactory([new Reference($factoryId), 'createConnection'])
                ->setArguments(
                    [
                        $name,
                        $config,
                    ]
                )
                ->addTag('connection', ['alias' => $name])
                ->addTag('connection.' . $config['driver'], ['alias' => $name]);

            $container->setDefinition('connection.' . $name, $definition);
        }

        return $this;
    }
}
