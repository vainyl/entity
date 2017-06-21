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

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Core\Extension\AbstractExtension;

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
        return [];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        $configuration = new EntityConfiguration();
        $documentConfiguration = $this->processConfiguration($configuration, $configs);

        $databaseId = 'database.' . $documentConfiguration['database'];
        $factoryId = 'entity.operation.factory.' . $documentConfiguration['factory'];
        $hydratorId = 'entity.hydrator.' . $documentConfiguration['hydrator'];
        $container->setAlias('database.entity', new Alias($databaseId));
        $container->setAlias('entity.operation.factory', new Alias($factoryId));
        $container->setAlias('entity.hydrator', new Alias($hydratorId));


        return $this;
    }
}