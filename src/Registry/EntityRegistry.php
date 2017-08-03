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

use Psr\Container\ContainerInterface;
use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;

/**
 * Class EntityRegistry
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityRegistry extends AbstractStorageDecorator implements EntityRegistryInterface
{
    private $container;

    /**
     * EntityRegistry constructor.
     *
     * @param StorageInterface   $storage
     * @param ContainerInterface $container
     */
    public function __construct(StorageInterface $storage, ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct($storage);
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
        return $this->container->get($alias);
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