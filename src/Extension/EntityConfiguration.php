<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Document
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Entity\Extension;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class EntityConfiguration
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EntityConfiguration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('entity');

        $rootNode
            ->children()
                ->scalarNode('orm')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}