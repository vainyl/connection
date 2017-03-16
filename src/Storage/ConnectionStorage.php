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
namespace Vainyl\Connection\Storage;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;
use Vainyl\Core\Id\Storage\AbstractIdentifiableStorage;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionStorage extends AbstractIdentifiableStorage
{
    private $connections = [];

    private $connectionFactory;

    /**
     * ConnectionStorage constructor.
     *
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function __construct(ConnectionFactoryInterface $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @param string $alias
     *
     * @return ConnectionInterface
     */
    public function getConnection(string $alias): ConnectionInterface
    {
        if (false === array_key_exists($alias, $this->connections)) {
            $this->connections[$alias] = $this->connectionFactory->decorate($this->offsetGet($alias));
        }

        return $this->connections[$alias];
    }
}