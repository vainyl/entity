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
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class EntityExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [
            new EntityHydratorCompilerPass(),
            new EntityOperationFactoryCompilerPass(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        if (false === $container->hasDefinition('entity.registry')) {
            throw new MissingRequiredServiceException($container, 'entity.registry');
        }

        $configuration = new EntityConfiguration();
        $entityConfiguration = $this->processConfiguration($configuration, $configs);

        if (false === $container->hasDefinition('entity.operation.factory')) {
            throw new MissingRequiredServiceException($container, 'entity.operation.factory');
        }
        $factoryDefinition = $container->findDefinition('entity.operation.factory');
        $factoryDefinition->replaceArgument(0, $entityConfiguration['factory']);

        if (false === $container->hasDefinition('entity.hydrator')) {
            throw new MissingRequiredServiceException($container, 'entity.hydrator');
        }
        $hydratorDefinition = $container->findDefinition('entity.hydrator');
        $hydratorDefinition->replaceArgument(0, $entityConfiguration['factory']);
        if (false === $container->hasDefinition('database.entity')) {
            throw new MissingRequiredServiceException($container, 'database.entity');
        }

        $container
            ->findDefinition('database.entity')
            ->replaceArgument(0, sprintf('database.%s', $entityConfiguration['database']));

        return $this;
    }
}