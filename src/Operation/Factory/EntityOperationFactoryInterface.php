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

namespace Vainyl\Entity\Operation\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Entity\EntityInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class EntityOperationFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityOperationFactoryInterface extends IdentifiableInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return OperationInterface
     */
    public function create(EntityInterface $entity) : OperationInterface;

    /**
     * @param EntityInterface $newEntity
     * @param EntityInterface $oldEntity
     *
     * @return OperationInterface
     */
    public function update(EntityInterface $newEntity, EntityInterface $oldEntity) : OperationInterface;

    /**
     * @param EntityInterface $entity
     *
     * @return OperationInterface
     */
    public function delete(EntityInterface $entity) : OperationInterface;

    /**
     * @param EntityInterface $entity
     *
     * @return OperationInterface
     */
    public function upsert(EntityInterface $entity) : OperationInterface;
}