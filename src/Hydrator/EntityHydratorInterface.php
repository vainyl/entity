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

namespace Vainyl\Entity\Hydrator;

use Vainyl\Entity\EntityInterface;

/**
 * Interface EntityHydratorInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityHydratorInterface
{
    /**
     * @param string $name
     * @param array  $entityData
     *
     * @return EntityInterface
     */
    public function create(string $name, array $entityData) : EntityInterface;
}