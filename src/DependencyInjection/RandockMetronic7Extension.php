<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Randock\Metronic7Bundle\Menu\MenuBuilder1;
use Randock\Metronic7Bundle\Menu\MenuBuilder5;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class RandockMetronic7Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $def = $container->getDefinition('metronic.menu_builder');
        if (1 === $config['layout']) {
            $def->setClass(MenuBuilder1::class);
        } elseif (5 === $config['layout']) {
            $def->setClass(MenuBuilder5::class);
        }
    }
}
