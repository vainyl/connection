<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   connection
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);
namespace Vainyl\Connection\Factory\Decorator;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;

/**
 * Class AbstractConnectionFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnectionFactoryDecorator implements ConnectionFactoryInterface
{
    private $connectionFactory;

    /**
     * AbstractConnectionFactoryDecorator constructor.
     *
     * @param ConnectionFactoryInterface $connectionFactory
     */
    public function __construct(ConnectionFactoryInterface $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return $this->connectionFactory->decorate($connection);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->connectionFactory->getId();
    }
}
