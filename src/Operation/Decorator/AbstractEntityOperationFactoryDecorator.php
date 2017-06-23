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
use Vainyl\Operation\OperationInterface;

/**
 * Class AbstractEntityOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractEntityOperationFactoryDecorator implements EntityOperationFactoryInterface
{
    private $operationFactory;

    /**
     * AbstractEntityOperationFactoryDecorator constructor.
     *
     * @param EntityOperationFactoryInterface $operationFactory
     */
    public function __construct(EntityOperationFactoryInterface $operationFactory)
    {
        $this->operationFactory = $operationFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity): OperationInterface
    {
        return $this->operationFactory->create($entity);
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $newEntity, EntityInterface $oldEntity): OperationInterface
    {
        return $this->operationFactory->update($newEntity, $oldEntity);
    }

    /**
     * @inheritDoc
     */
    public function delete(EntityInterface $entity): OperationInterface
    {
        return $this->operationFactory->delete($entity);
    }

    /**
     * @inheritDoc
     */
    public function upsert(EntityInterface $entity): OperationInterface
    {
        return $this->operationFactory->upsert($entity);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->operationFactory->getId();
    }
}