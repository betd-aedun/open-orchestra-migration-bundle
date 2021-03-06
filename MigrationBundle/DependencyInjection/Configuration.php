<?php

namespace OpenOrchestra\MigrationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('open_orchestra_migration');

        $rootNode->children()
            ->arrayNode('node_configuration')->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('template_configuration')->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('defaultTemplate')->defaultValue('default')->end()
                            ->arrayNode('specificTemplate')
                            ->useAttributeAsKey('template')
                            ->info('Specific template for a nodeId')
                            ->defaultValue(array(
                                'default' => array('root'),
                            ))
                            ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('error_node_ids')
                        ->defaultValue(array('errorPage404', 'errorPage503'))
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
