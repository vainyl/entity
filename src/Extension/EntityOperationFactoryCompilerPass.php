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

namespace Vainyl\Entity\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractCompilerPass;

/**
 * Class EntityOperationFactoryCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityOperationFactoryCompilerPass extends AbstractCompilerPass
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('entity.registry'))) {
            throw new MissingRequiredServiceException($container, 'entity.registry');
        }

        $registryDefinition = $container->getDefinition('entity.registry');
        foreach ($container->findTaggedServiceIds('entity.operation.factory') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('alias', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'alias');
                }

                $registryDefinition
                    ->addMethodCall('addFactory', [$attributes['alias'], new Reference($id)]);
            }
        }

        return $this;
    }
}