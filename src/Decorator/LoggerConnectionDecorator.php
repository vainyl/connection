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

use Psr\Log\LoggerInterface;
use Vainyl\Connection\ConnectionInterface;

/**
 * Class LoggerConnectionDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerConnectionDecorator extends AbstractConnectionDecorator
{
    private $logger;

    /**
     * ConnectionLoggerDecorator constructor.
     *
     * @param ConnectionInterface $connection
     * @param LoggerInterface     $logger
     */
    public function __construct(ConnectionInterface $connection, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($connection);
    }

    /**
     * @inheritDoc
     */
    public function establish()
    {
        $this->logger->debug(sprintf('Establishing connection %s', $this->getName()));
        $connection = parent::establish();
        $this->logger->debug(sprintf('Successfully established connection %s', $this->getName()));

        return $connection;
    }
}
