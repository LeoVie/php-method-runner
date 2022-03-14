<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PhpMethodRunnerExtension extends Extension
{
    private const CONFIG_DIR = __DIR__ . '/../../config/';

    /**
     * @param mixed[] $configs
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configDir = new FileLocator(self::CONFIG_DIR);

        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yaml');

        /** @var array{directories: array{template_directory: string, generated_directory: string}} */
        $config = $this->processConfiguration(new Configuration(), $configs);

        $definition = $container->getDefinition(\LeoVie\PhpMethodRunner\Configuration\Configuration::class);
        $definition->replaceArgument(0, $config['directories']['template_directory']);
        $definition->replaceArgument(1, $config['directories']['generated_directory']);
    }
}