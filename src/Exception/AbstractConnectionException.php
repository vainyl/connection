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

namespace Vainyl\Connection\Exception;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractConnectionException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnectionException extends AbstractCoreException implements ConnectionExceptionInterface
{
    private $connection;

    /**
     * AbstractConnectionException constructor.
     *
     * @param ConnectionInterface $connection
     * @param string              $message
     * @param int                 $code
     * @param \Throwable|null     $previous
     */
    public function __construct(
        ConnectionInterface $connection,
        string $message,
        int $code = 500,
        \Throwable $previous = null
    ) {
        $this->connection = $connection;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}
