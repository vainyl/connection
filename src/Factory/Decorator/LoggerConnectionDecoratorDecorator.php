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

namespace Vainyl\Connection\Factory\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Decorator\LoggerConnectionDecorator;
use Vainyl\Connection\Factory\ConnectionDecoratorInterface;

/**
 * Class LoggerConnectionDecoratorDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerConnectionDecoratorDecorator extends AbstractConnectionDecoratorDecorator
{
    private $logger;

    /**
     * LoggerConnectionDecoratorDecorator constructor.
     *
     * @param ConnectionDecoratorInterface $connectionDecorator
     * @param LoggerInterface              $logger
     */
    public function __construct(ConnectionDecoratorInterface $connectionDecorator, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($connectionDecorator);
    }

    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return new LoggerConnectionDecorator(parent::decorate($connection), $this->logger);
    }
}
