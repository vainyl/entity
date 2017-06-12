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

namespace Vainyl\Entity;

use Vainyl\Core\ArrayInterface;
use Vainyl\Core\NameableInterface;

/**
 * Interface EntityInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityInterface extends ArrayInterface, NameableInterface
{
}