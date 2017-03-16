<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   connection
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);

namespace Vainyl\Connection\Extension;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class ConnectionConfiguration
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionConfiguration implements ConfigurationInterface
{
    /**
     * @return mixed
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('connections');

        $rootNode
            ->prototype('array')
                ->children()
                    ->scalarNode('driver')
                        ->isRequired()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}