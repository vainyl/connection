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
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class ConnectionDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionDecorator extends AbstractIdentifiable implements ConnectionDecoratorInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return $connection;
    }
}