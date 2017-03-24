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
declare(strict_types = 1);
namespace Vainyl\Connection\Storage;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;
use Vainyl\Core\Storage\Proxy\AbstractStorageProxy;
use Vainyl\Core\Storage\StorageInterface;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionStorage extends AbstractStorageProxy
{
    private $connectionFactory;

    /**
     * ConnectionStorage constructor.
     *
     * @param StorageInterface           $storage
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
     *
     * @return ConnectionInterface
     */
    public function getConnection(string $alias): ConnectionInterface
    {
        return $this->offsetGet($alias);
    }
}
