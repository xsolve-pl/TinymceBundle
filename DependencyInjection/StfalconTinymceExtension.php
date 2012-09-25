<?php

namespace Stfalcon\Bundle\TinymceBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;

/**
 * StfalconTinymceExtension
 */
class StfalconTinymceExtension extends Extension
{
    /**
     * Loads the StfalconTinymce configuration.
     *
     * @param array            $configs   An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        foreach ($configs as $c) {
            $config = array_merge($config, $c);
        }

        // Use jQuery or standalone build of the TinyMCE
        $config['tinymce_jquery'] = isset($config['tinymce_jquery']) ? (bool) $config['tinymce_jquery'] : false;

        // Include jQuery library
        $config['include_jquery'] = isset($config['include_jquery']) ? (bool) $config['include_jquery'] : false;

        // Set target element (textarea) selector
        if (isset($config['textarea_class']) && $config['textarea_class']) {
            $config['textarea_class']  = ($config['tinymce_jquery'] ? '.' : '') . $config['textarea_class'];
        }

        $container->setParameter('stfalcon_tinymce.config', $config);

        $container->setParameter('stfalcon_tinymce.include_jquery', isset($config['include_jquery']) ? $config['include_jquery'] : true);
        $container->setParameter('stfalcon_tinymce.upload_directory', $config['upload_directory']);
        $container->setParameter('stfalcon_tinymce.web_path', $config['web_path']);

        // load dependency injection config
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('service.xml');
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'stfalcon_tinymce';
    }
}
