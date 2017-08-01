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

use Vainyl\Domain\DomainInterface;
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
     * @param EntityInterface $domain
     *
     * @return OperationInterface
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new CreateEntityEvent($domain))
            )
            ->add(parent::create($domain));
    }

    /**
     * @param EntityInterface $domain
     *
     * @return OperationInterface
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new DeleteEntityEvent($domain))
            )
            ->add(parent::delete($domain));
    }

    /**
     * @param EntityInterface $newDomain
     * @param EntityInterface $oldDomain
     *
     * @return OperationInterface
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpdateEntityEvent($newDomain, $oldDomain))
            )
            ->add(parent::update($newDomain, $oldDomain));
    }

    /**
     * @param EntityInterface $domain
     *
     * @return OperationInterface
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpsertEntityEvent($domain))
            )
            ->add(parent::upsert($domain));
    }
}