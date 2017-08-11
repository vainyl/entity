<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Entity
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Entity\Registry;

use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Core\IdentifiableInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;

/**
 * Interface EntityRegistryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityRegistryInterface extends IdentifiableInterface
{
    /**
     * @param string                          $alias
     * @param EntityOperationFactoryInterface $factory
     *
     * @return EntityRegistryInterface
     */
    public function addFactory(string $alias, EntityOperationFactoryInterface $factory): EntityRegistryInterface;

    /**
     * @param string            $alias
     * @param HydratorInterface $hydrator
     *
     * @return EntityRegistryInterface
     */
    public function addHydrator(string $alias, HydratorInterface $hydrator): EntityRegistryInterface;

    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getDatabase(string $alias): DatabaseInterface;

    /**
     * @param string $alias
     *
     * @return EntityOperationFactoryInterface
     */
    public function getFactory(string $alias): EntityOperationFactoryInterface;

    /**
     * @param string $alias
     *
     * @return HydratorInterface
     */
    public function getHydrator(string $alias): HydratorInterface;
}