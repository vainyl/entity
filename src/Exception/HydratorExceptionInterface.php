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

use Vainyl\Entity\Hydrator\EntityHydratorInterface;

/**
 * Class HydratorExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HydratorExceptionInterface extends \Throwable
{
    /**
     * @return EntityHydratorInterface
     */
    public function getHydrator() : EntityHydratorInterface;
}