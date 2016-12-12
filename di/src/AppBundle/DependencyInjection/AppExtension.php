<?php


namespace AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class AppExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        var_dump($configs);

        $configuration = $this->getConfiguration([], $container);
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, $configs);
    }
}
