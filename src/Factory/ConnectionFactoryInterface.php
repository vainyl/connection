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

namespace Vainyl\Connection\Factory;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\IdentifiableInterface;

/**
 * Interface ConnectionFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $name
     * @param string $host
     * @param int    $port
     * @param string $userName
     * @param string $password
     * @param array  $options
     *
     * @return ConnectionInterface
     */
    public function createConnection(
        string $name,
        string $host,
        int $port,
        string $userName,
        string $password,
        array $options
    ): ConnectionInterface;
}
