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
use Vainyl\Core\Extension\AbstractCompilerPass;
use Vainyl\Core\Extension\Exception\MissingRequiredFieldException;
use Vainyl\Core\Extension\Exception\MissingRequiredServiceException;

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

        $services = $container->findTaggedServiceIds('connection');
        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                if ('connection' !== $tag['name']) {
                    continue;
                }
                if (false === array_key_exists('alias', $tag)) {
                    throw new MissingRequiredFieldException($container, $id, $tag, 'alias');
                }
                $alias = $tag['alias'];
                $definition = $container->getDefinition($id);
                $inner = $id . '.inner';
                $container->setDefinition($inner, $definition);

                $containerDefinition = $container->getDefinition('connection.storage');
                $containerDefinition
                    ->addMethodCall('offsetSet', [$alias, new Reference($inner)]);

                $decoratedDefinition = (new Definition())
                    ->setFactory(['connection.storage', 'getConnection'])
                    ->setArguments($alias);

                $container->setDefinition($id, $decoratedDefinition);
            }
        }

        return $this;
    }
}
