<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('leovie_php_method_runner');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('directories')
                    ->children()
                        ->scalarNode('template_directory')->end()
                        ->scalarNode('generated_directory')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}