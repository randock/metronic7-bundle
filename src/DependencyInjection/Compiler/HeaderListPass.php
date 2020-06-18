<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Randock\Metronic7Bundle\HeaderBuilder\HeaderList\Definition\HeaderListInterface;
use Randock\Metronic7Bundle\DependencyInjection\Compiler\Exception\ServiceDoesNotImplementHeaderListInterfaceException;

class HeaderListPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @throws ServiceDoesNotImplementHeaderListInterfaceException
     * @throws \ReflectionException
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('metronic.header_builder')) {
            return;
        }

        $definition = $container->findDefinition('metronic.header_builder');
        $taggedServices = $container->findTaggedServiceIds('metronic.header_list');

        $sortedServices = [];

        foreach ($taggedServices as $service => $tags) {
            $serviceDefinition = $container->findDefinition($service);
            $reflectionClass = new \ReflectionClass($serviceDefinition->getClass());
            if (!$reflectionClass->implementsInterface(HeaderListInterface::class)) {
                throw new ServiceDoesNotImplementHeaderListInterfaceException($serviceDefinition->getClass());
            }

            $sortedServices[$service] = $tags[0]['priority'] ?? INF;
        }

        asort($sortedServices);

        $definition->addMethodCall('setServices', [array_keys($sortedServices)]);
    }
}
