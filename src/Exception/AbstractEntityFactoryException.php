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
use Vainyl\Entity\Factory\EntityFactoryInterface;

/**
 * Class AbstractEntityFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEntityFactoryException extends AbstractCoreException implements EntityFactoryExceptionInterface
{
    private $factory;

    /**
     * AbstractEntityFactoryException constructor.
     *
     * @param EntityFactoryInterface $factory
     * @param string                 $message
     * @param int                    $code
     * @param \Exception|null        $previous
     */
    public function __construct(
        EntityFactoryInterface $factory,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->factory = $factory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getFactory(): EntityFactoryInterface
    {
        return $this->factory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['factory' => $this->factory->getId()], parent::toArray());
    }
}