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
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;

/**
 * Class EntityRegistry
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityRegistry extends AbstractStorageDecorator implements EntityRegistryInterface
{
    /**
     * @inheritDoc
     */
    public function addDatabase(string $alias, DatabaseInterface $database): EntityRegistryInterface
    {
        $this->offsetSet(sprintf('%s.database', $alias), $database);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addFactory(string $alias, EntityOperationFactoryInterface $factory): EntityRegistryInterface
    {
        $this->offsetSet(sprintf('%s.factory', $alias), $factory);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addHydrator(string $alias, HydratorInterface $hydrator): EntityRegistryInterface
    {
        $this->offsetSet(sprintf('%s.hydrator', $alias), $hydrator);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDatabase(string $alias): DatabaseInterface
    {
        return $this->offsetGet(sprintf('%s.database', $alias));
    }

    /**
     * @inheritDoc
     */
    public function getFactory(string $alias): EntityOperationFactoryInterface
    {
        return $this->offsetGet(sprintf('%s.factory', $alias));
    }

    /**
     * @inheritDoc
     */
    public function getHydrator(string $alias): HydratorInterface
    {
        return $this->offsetGet(sprintf('%s.hydrator', $alias));
    }
}