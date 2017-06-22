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

namespace Vainyl\Entity\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Entity\EntityInterface;

/**
 * Interface EntityFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $name
     * @param array  $entityData
     *
     * @return EntityInterface
     */
    public function create(string $name, array $entityData) : EntityInterface;
}