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

use Vainyl\Core\Id\AbstractIdentifiable;

/**
 * Class AbstractConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnection extends AbstractIdentifiable implements ConnectionInterface
{
    private $configData;

    private $connectionName;

    /**
     * AbstractConnection constructor.
     *
     * @param \ArrayAccess $configData
     * @param string       $connectionName
     */
    public function __construct(\ArrayAccess $configData, string $connectionName)
    {
        $this->configData = $configData;
        $this->connectionName = $connectionName;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->connectionName;
    }

    /**
     * @return array
     */
    public function getConfigData() : array
    {
        return $this->configData['connections'][$this->connectionName];
    }
}