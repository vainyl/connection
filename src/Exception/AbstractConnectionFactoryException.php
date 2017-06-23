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

use Vainyl\Connection\Factory\ConnectionFactoryInterface;
use Vainyl\Core\Exception\AbstractCoreException;

/**
 * Class AbstractConnectionFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractConnectionFactoryException extends AbstractCoreException implements ConnectionFactoryExceptionInterface
{
    private $connectionFactory;

    /**
     * AbstractConnectionFactoryException constructor.
     *
     * @param ConnectionFactoryInterface $connectionFactory
     * @param string                     $message
     * @param int                        $code
     * @param \Exception|null            $previous
     */
    public function __construct(
        ConnectionFactoryInterface $connectionFactory,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->connectionFactory = $connectionFactory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getConnectionFactory(): ConnectionFactoryInterface
    {
        return $this->connectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['connection_factory' => $this->connectionFactory->getId()], parent::toArray());
    }
}