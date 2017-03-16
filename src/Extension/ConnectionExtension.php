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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Extension\AbstractExtension;

/**
 * Class ConnectionExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionExtension extends AbstractExtension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return AbstractExtension
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $this
            ->processConfiguration(new ConnectionConfiguration(), $configs);

        $container
            ->addCompilerPass(new ConnectionCompilerPass());

        return parent::load($configs, $container);
    }
}
