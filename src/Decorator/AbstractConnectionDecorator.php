<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);

namespace Vainyl\Connection\Decorator;

use Vainyl\Connection\ConnectionInterface;

/**
 * Class AbstractConnectionDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnectionDecorator implements ConnectionInterface
{
    private $connection;

    /**
     * AbstractConnectionDecorator constructor.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->connection->getId();
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->connection->getName();
    }

    /**
     * @inheritDoc
     */
    public function establish()
    {
        return $this->connection->establish();
    }
}
