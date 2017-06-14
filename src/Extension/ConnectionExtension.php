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
use Vainyl\Core\Application\EnvironmentInterface;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractExtension;

/**
 * Class ConnectionExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function load(
        array $configs,
        ContainerBuilder $container,
        EnvironmentInterface $environment = null
    ): AbstractExtension {
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
                        $config['host'],
                        $config['port'],
                        $config['username'],
                        $config['password'],
                        $config['options'],
                    ]
                )
                ->addTag('connection', ['name' => $name]);
            $container->setDefinition('connection.' . $name, $definition);
        }
        $container->addCompilerPass(new ConnectionCompilerPass());

        return parent::load($configs, $container, $environment);
    }
}
