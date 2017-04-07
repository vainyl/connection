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
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\Exception\MissingRequiredFieldException;

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
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $container
            ->addCompilerPass(new ConnectionCompilerPass());

        foreach ($configs as $config) {
            if (false === array_key_exists('connections', $config)) {
                continue;
            }

            foreach ($config['connections'] as $name => $configData) {
                if (false === array_key_exists('driver', $configData)) {
                    throw new MissingRequiredFieldException($container, $name, $configData, 'driver');
                }
                $definition = (new Definition())
                    ->setFactory(['connection.factory.' . $configData['driver'], 'createConnection'])
                    ->setArguments([$name, $configData])
                    ->addTag('connection');

                $container->setDefinition('connection.' . $name, $definition);
            }
        }
        $container->addCompilerPass(new ConnectionCompilerPass());

        return parent::load($configs, $container);
    }
}
