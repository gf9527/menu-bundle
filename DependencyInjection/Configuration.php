<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\MenuBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('glory_menu');

        $this->addMenuClassConfiguration($rootNode);
        $this->addMenuTemplateConfiguration($rootNode);

        return $treeBuilder;
    }

    protected function addMenuClassConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('menu_class')->isRequired()->info('menu class must required')->example('AppBundle\\Entity\\Menu')->end()
            ->end();
    }
    
    protected function addMenuTemplateConfiguration(ArrayNodeDefinition $node){
        $node
            ->children()
                ->arrayNode('template')
                //->useAttributeAsKey('name')
                ->end()
            ->end();
    }

}
