<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Routing\Loader\XmlFileLoader;

class PhpMethodRunnerExtension extends Extension
{
    /**
     * @param mixed[] $configs
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configFile = new FileLocator(__DIR__ . '/../../config/');

        $loader = new XmlFileLoader($configFile);
        $loader->load('services.xml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $definition = $container->getDefinition(\LeoVie\PhpMethodRunner\Configuration\Configuration::class);
        $definition->replaceArgument(0, $config['directories']['template_directory']);
        $definition->replaceArgument(1, $config['directories']['generated_directory']);
    }
}