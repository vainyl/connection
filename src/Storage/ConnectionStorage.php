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

namespace Vainyl\Connection\Storage;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Core\Storage\StorageInterface;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionStorage extends AbstractStorageDecorator
{
    private $connectionFactory;

    /**
     * ConnectionStorage constructor.
     *
     * @param StorageInterface $storage
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function __construct(StorageInterface $storage, ConnectionFactoryInterface $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
        parent::__construct($storage);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->connectionFactory->decorate(parent::offsetGet($offset));
    }

    /**
     * @param string $alias
     * @param ConnectionInterface $connection
     *
     * @return ConnectionStorage
     */
    public function addConnection(string $alias, ConnectionInterface $connection)
    {
        $this->offsetSet($alias, $connection);

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return ConnectionInterface
     */
    public function getConnection(string $alias): ConnectionInterface
    {
        return $this->offsetGet($alias);
    }
}
