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

namespace Vainyl\Connection\Exception;

use Vainyl\Connection\Factory\ConnectionFactoryInterface;

/**
 * Interface ConnectionFactoryExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionFactoryExceptionInterface
{
    /**
     * @return ConnectionFactoryInterface
     */
    public function getConnectionFactory() : ConnectionFactoryInterface;
}