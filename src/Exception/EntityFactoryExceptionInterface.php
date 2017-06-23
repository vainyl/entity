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

use Vainyl\Entity\Factory\EntityFactoryInterface;

/**
 * Interface EntityFactoryExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityFactoryExceptionInterface extends \Throwable
{
    /**
     * @return EntityFactoryInterface
     */
    public function getFactory() : EntityFactoryInterface;
}