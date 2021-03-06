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

namespace Vainyl\Connection\Factory;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface ConnectionDecoratorInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionDecoratorInterface extends IdentifiableInterface
{
    /**
     * @param ConnectionInterface $connection
     *
     * @return ConnectionInterface
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface;
}