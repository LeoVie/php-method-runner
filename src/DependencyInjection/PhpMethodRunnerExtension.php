<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PhpMethodRunnerExtension extends Extension
{
    /**
     * @param mixed[] $configs
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configDir = new FileLocator(__DIR__ . '/../../config/');

        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yaml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $definition = $container->getDefinition(\LeoVie\PhpMethodRunner\Configuration\Configuration::class);
        $definition->setArgument(0, $config['directories']['template_directory']);
        $definition->setArgument(1, $config['directories']['generated_directory']);
    }
}