<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('randock_metronic5');

        $rootNode
            ->children()
            ->enumNode('layout')->values([1, 5])->isRequired()->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
