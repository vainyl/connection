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
namespace Vainyl\Connection\Factory\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Decorator\LoggerConnectionDecorator;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;

/**
 * Class LoggerConnectionFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerConnectionFactoryDecorator extends AbstractConnectionFactoryDecorator
{
    private $logger;

    /**
     * LoggerConnectionFactoryDecorator constructor.
     *
     * @param ConnectionFactoryInterface $connectionFactory
     * @param LoggerInterface            $logger
     */
    public function __construct(ConnectionFactoryInterface $connectionFactory, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($connectionFactory);
    }

    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return new LoggerConnectionDecorator(parent::decorate($connection), $this->logger);
    }
}
