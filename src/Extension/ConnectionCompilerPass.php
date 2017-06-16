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
use Vainyl\Core\Extension\AbstractCompilerPass;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;

/**
 * Class ConnectionCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionCompilerPass extends AbstractCompilerPass
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('connection.storage'))) {
            throw new MissingRequiredServiceException($container, 'connection.storage');
        }

        if (false === ($container->hasDefinition('connection.decorator'))) {
            throw new MissingRequiredServiceException($container, 'connection.decorator');
        }

        $services = $container->findTaggedServiceIds('connection');
        foreach ($services as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('name', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'name');
                }

                if (false === array_key_exists('decorate', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'decorate');
                }
                $name = $attributes['name'];
                $definition = $container->getDefinition($id);
                $inner = $id . '.inner';
                $container->setDefinition($inner, $definition);

                if ($attributes['decorate']) {
                    $decoratedDefinition = (new Definition())
                        ->setClass(ConnectionInterface::class)
                        ->setFactory([new Reference('connection.decorator'), 'decorate'])
                        ->setArguments([new Reference($inner)]);
                    $inner .= '.decorated';
                    $container->setDefinition($inner, $decoratedDefinition);
                }

                $containerDefinition = $container->getDefinition('connection.storage');
                $containerDefinition
                    ->addMethodCall('addConnection', [$name, new Reference($inner)]);

                $storageDefinition = (new Definition())
                    ->setClass(ConnectionInterface::class)
                    ->setFactory([new Reference('connection.storage'), 'getConnection'])
                    ->setArguments([$name]);

                $container->setDefinition($id, $storageDefinition);
            }
        }

        return $this;
    }
}
