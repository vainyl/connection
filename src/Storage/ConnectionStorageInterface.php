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
namespace Vainyl\Connection\Storage;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\Storage\StorageInterface;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionStorageInterface extends StorageInterface
{
    /**
     * @param string $alias
     *
     * @return ConnectionInterface
     */
    public function getConnection(string $alias): ConnectionInterface;
}