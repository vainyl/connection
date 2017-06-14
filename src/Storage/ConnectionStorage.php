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
use Vainyl\Connection\Factory\ConnectionDecoratorInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Core\Storage\StorageInterface;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionStorage extends AbstractStorageDecorator
{
    private $connectionDecorator;

    /**
     * ConnectionStorage constructor.
     *
     * @param StorageInterface             $storage
     * @param ConnectionDecoratorInterface $connectionDecorator
     */
    public function __construct(StorageInterface $storage, ConnectionDecoratorInterface $connectionDecorator)
    {
        $this->connectionDecorator = $connectionDecorator;
        parent::__construct($storage);
    }

    /**
     * @param string              $alias
     * @param ConnectionInterface $connection
     *
     * @return ConnectionStorage
     */
    public function addConnection(string $alias, ConnectionInterface $connection)
    {
        $this->offsetSet($alias, $this->connectionDecorator->decorate($connection));

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
