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
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;
use Vainyl\Entity\Operation\SetCreatedAtOperation;
use Vainyl\Entity\Operation\SetUpdatedAtOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;
use Vainyl\Time\Provider\TimeProviderInterface;

/**
 * Class TimestampEntityOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TimestampEntityOperationFactoryDecorator extends AbstractEntityOperationFactoryDecorator
{
    private $collectionFactory;

    private $timeProvider;

    /**
     * TimestampEntityOperationFactoryDecorator constructor.
     *
     * @param EntityOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface      $collectionFactory
     * @param TimeProviderInterface           $timeProvider
     */
    public function __construct(
        EntityOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        TimeProviderInterface $timeProvider
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timeProvider = $timeProvider;
        parent::__construct($operationFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::create($entity))
            ->add(
                new SetCreatedAtOperation($entity, $this->timeProvider->getCurrentTime())
            );
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $newEntity, EntityInterface $oldEntity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(parent::update($newEntity, $oldEntity))
            ->add(
                new SetUpdatedAtOperation($newEntity, $this->timeProvider->getCurrentTime())
            );
    }

    /**
     * @inheritDoc
     */
    public function upsert(EntityInterface $entity): OperationInterface
    {
        $collection = $this->collectionFactory
            ->create()
            ->add(parent::upsert($entity));
        if (null === $entity->createdAt()) {
            $collection->add(new SetCreatedAtOperation($entity, $this->timeProvider->getCurrentTime()));
        }

        if (null === $entity->updatedAt()) {
            $collection->add(new SetUpdatedAtOperation($entity, $this->timeProvider->getCurrentTime()));
        }

        return $collection;
    }
}