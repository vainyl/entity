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
 * Class DeleteEntityEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DeleteEntityEvent extends AbstractIdentifiable implements EventInterface
{
    private $entity;

    /**
     * UpdateEntityEvent constructor.
     *
     * @param EntityInterface $oldEntity
     */
    public function __construct(EntityInterface $oldEntity)
    {
        $this->entity = $oldEntity;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->entity->getName() . '.' . 'delete';
    }

    /**
     * @return EntityInterface
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }
}