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

namespace Vainyl\Entity\Operation;

use Vainyl\Core\ResultInterface;
use Vainyl\Entity\EntityInterface;
use Vainyl\Operation\AbstractOperation;
use Vainyl\Operation\SuccessfulOperationResult;
use Vainyl\Time\TimeInterface;

/**
 * Class SetCreatedAtOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SetCreatedAtOperation extends AbstractOperation
{
    private $entity;

    private $time;

    /**
     * SetUpdatedAtOperation constructor.
     *
     * @param EntityInterface $entity
     * @param TimeInterface   $time
     */
    public function __construct(EntityInterface $entity, TimeInterface $time)
    {
        $this->entity = $entity;
        $this->time = $time;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $this->entity->setCreatedAt($this->time);

        return new SuccessfulOperationResult($this);
    }
}