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
use Vainyl\Domain\Operation\Decorator\AbstractDomainOperationFactoryDecorator;
use Vainyl\Entity\EntityInterface;
use Vainyl\Entity\Operation\Factory\EntityOperationFactoryInterface;

/**
 * Class AbstractEntityOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEntityOperationFactoryDecorator extends AbstractDomainOperationFactoryDecorator implements
    EntityOperationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function supports(DomainInterface $domain): bool
    {
        return $domain instanceof EntityInterface && parent::supports($domain);
    }
}