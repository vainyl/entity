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

namespace Vainyl\Entity\Event;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Entity\EntityInterface;
use Vainyl\Event\EventInterface;

/**
 * Class UpdateEntityEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpdateEntityEvent extends AbstractIdentifiable implements EventInterface
{
    private $newEntity;

    private $oldEntity;

    /**
     * UpdateEntityEvent constructor.
     *
     * @param EntityInterface $newEntity
     * @param EntityInterface $oldEntity
     */
    public function __construct(EntityInterface $newEntity, EntityInterface $oldEntity)
    {
        $this->newEntity = $newEntity;
        $this->oldEntity = $oldEntity;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('entity.%s.update', $this->newEntity->getName());
    }

    /**
     * @return EntityInterface
     */
    public function getNewEntity(): EntityInterface
    {
        return $this->newEntity;
    }

    /**
     * @return EntityInterface
     */
    public function getOldEntity(): EntityInterface
    {
        return $this->oldEntity;
    }
}