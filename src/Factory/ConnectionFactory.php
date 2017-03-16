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
namespace Vainyl\Connection\Factory;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\Id\AbstractIdentifiable;

/**
 * Class ConnectionFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionFactory extends AbstractIdentifiable implements ConnectionFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return $connection;
    }
}
