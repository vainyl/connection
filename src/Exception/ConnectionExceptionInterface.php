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

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\ArrayInterface;

/**
 * Interface ConnectionExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionExceptionInterface extends ArrayInterface, \Throwable
{
    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface;
}