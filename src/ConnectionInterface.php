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
namespace Vainyl\Connection;

use Vainyl\Core\Name\NameableInterface;

/**
 * Interface ConnectionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionInterface extends NameableInterface
{
    /**
     * @return mixed
     */
    public function establish();
}
