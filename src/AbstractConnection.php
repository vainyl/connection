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
    private $connectionName;

    private $configData;

    /**
     * AbstractConnection constructor.
     *
     * @param string $connectionName
     * @param array  $configData
     */
    public function __construct(string $connectionName, array $configData)
    {
        $this->connectionName = $connectionName;
        $this->configData = $configData;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->connectionName;
    }

    /**
     * @return array
     */
    public function getConfigData(): array
    {
        return $this->configData;
    }
}
