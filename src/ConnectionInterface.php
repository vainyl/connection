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
namespace Vainyl\Connection;

use Vainyl\Core\NameableInterface;

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
