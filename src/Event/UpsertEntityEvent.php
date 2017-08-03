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
 * Class UpsertEntityEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpsertEntityEvent extends AbstractIdentifiable implements EventInterface
{
    private $entity;

    /**
     * UpsertEntityEvent constructor.
     *
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return EntityInterface
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('entity.%s.upsert', $this->entity->getName());
    }
}