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

namespace Vainyl\Entity\Exception;

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Entity\Hydrator\EntityHydratorInterface;

/**
 * Class AbstractHydratorException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractHydratorException extends AbstractCoreException implements HydratorExceptionInterface
{
    private $hydrator;

    /**
     * AbstractHydratorException constructor.
     *
     * @param EntityHydratorInterface $hydrator
     * @param string                  $message
     * @param int                     $code
     * @param \Exception|null         $previous
     */
    public function __construct(
        EntityHydratorInterface $hydrator,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->hydrator = $hydrator;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getHydrator(): EntityHydratorInterface
    {
        return $this->hydrator;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['hydrator' => $this->hydrator->getId()], parent::toArray());
    }
}