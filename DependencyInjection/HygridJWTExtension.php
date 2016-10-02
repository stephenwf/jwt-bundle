<?php

namespace Hygrid\JWTBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class HygridJWTExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('hygrid_jwt.signing.public_key', $config['signing']['public_key']);
        $container->setParameter('hygrid_jwt.signing.private_key', $config['signing']['private_key']);
        $container->setParameter('hygrid_jwt.signing.signer', $config['signing']['private_key']);
        $container->setParameter('hygrid_jwt.issuer', $config['issuer']);
        $container->setParameter('hygrid_jwt.token_expiry', $config['token_expiry']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
