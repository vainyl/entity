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
use Vainyl\Core\Extension\AbstractExtension;

/**
 * Class EntityExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $configuration = new EntityConfiguration();
        $documentConfiguration = $this->processConfiguration($configuration, $configs);

        $container->removeDefinition('database.entity');
        $container->removeDefinition('entity.operation.factory');
        $container->setAlias('database.entity', new Alias('database.entity.' . $documentConfiguration['orm']));
        $container->setAlias(
            'entity.operation.factory',
            new Alias('entity.operation.factory' . $documentConfiguration['orm'])
        );

        return parent::load($configs, $container);
    }
}