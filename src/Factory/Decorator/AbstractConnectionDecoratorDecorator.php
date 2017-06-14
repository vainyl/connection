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

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionDecoratorInterface;

/**
 * Class AbstractConnectionDecoratorDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnectionDecoratorDecorator implements ConnectionDecoratorInterface
{
    private $connectionDecorator;

    /**
     * AbstractConnectionDecoratorDecorator constructor.
     *
     * @param ConnectionDecoratorInterface $connectionDecorator
     */
    public function __construct(ConnectionDecoratorInterface $connectionDecorator)
    {
        $this->connectionDecorator = $connectionDecorator;
    }

    /**
     * @inheritDoc
     */
    public function decorate(ConnectionInterface $connection): ConnectionInterface
    {
        return $this->connectionDecorator->decorate($connection);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->connectionDecorator->getId();
    }
}
