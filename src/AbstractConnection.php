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

namespace Vainyl\Connection;

use Vainyl\Core\AbstractIdentifiable;

/**
 * Class AbstractConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnection extends AbstractIdentifiable implements ConnectionInterface
{
    private $name;

    private $instance;

    /**
     * AbstractConnection constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    abstract public function doEstablish();

    /**
     * @inheritDoc
     */
    public function establish()
    {
        if (null === $this->instance) {
            $this->instance = $this->doEstablish();
        }

        return $this->instance;
    }
}
