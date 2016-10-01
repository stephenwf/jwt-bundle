<?php

namespace Hygrid\JWTBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('hygrid_jwt');

        $rootNode
            ->children()
                ->scalarNode('issuer')->end()
                ->integerNode('usage_delay')->defaultNull()->end()
                ->integerNode('token_expiry')->defaultValue(120)->end()
                ->scalarNode('jti_claim')->defaultNull()->end()
                ->arrayNode('signing')
                    ->children()
                        ->integerNode('signer')->defaultValue('hygrid_jwt.signers.sha256')->end()
                        ->scalarNode('public_key')->end()
                        ->scalarNode('private_key')->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
