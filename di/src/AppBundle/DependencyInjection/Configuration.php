<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('app');

        $rootNode
            ->fixXmlConfig('array_element')
            ->children()
                ->arrayNode('array_elements')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->integerNode('integer_element')->end()
                            ->scalarNode('text_element')->end()
                        ->end()
                    ->end()
                ->end()
                ->integerNode('some_integer')->defaultValue('0')->end()
                ->scalarNode('some_text')->end()

            ->end();

        return $treeBuilder;
    }
}
