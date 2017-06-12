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

namespace Vainyl\Entity\Operation\Decorator;

use Vainyl\Entity\EntityInterface;
use Vainyl\Entity\Event\CreateEntityEvent;
use Vainyl\Entity\Event\DeleteEntityEvent;
use Vainyl\Entity\Event\UpdateEntityEvent;
use Vainyl\Entity\Event\UpsertEntityEvent;
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;
use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Operation\DispatchEventOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class EntityOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventEntityOperationFactoryDecorator extends AbstractEntityOperationFactoryDecorator
{
    private $collectionFactory;

    private $eventDispatcher;

    /**
     * EventEntityOperationFactoryDecorator constructor.
     *
     * @param EntityOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface      $collectionFactory
     * @param EventDispatcherInterface        $eventDispatcher
     */
    public function __construct(
        EntityOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct($operationFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::create($entity))->add(
                new DispatchEventOperation($this->eventDispatcher, new CreateEntityEvent($entity))
            );
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $newEntity, EntityInterface $oldEntity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::update($newEntity, $oldEntity))->add(
                new DispatchEventOperation($this->eventDispatcher, new UpdateEntityEvent($newEntity, $oldEntity))
            );
    }

    /**
     * @inheritDoc
     */
    public function delete(EntityInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::delete($entity))->add(
                new DispatchEventOperation($this->eventDispatcher, new DeleteEntityEvent($entity))
            );
    }

    /**
     * @inheritDoc
     */
    public function upsert(EntityInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::upsert($entity))->add(
                new DispatchEventOperation($this->eventDispatcher, new UpsertEntityEvent($entity))
            );
    }
}