<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\HeaderBuilder;

use Symfony\Component\DependencyInjection\Container;

class HeaderBuilder
{
    private array $services;
    private Container $container;

    /**
     * HeaderBuilder constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $services
     *
     * @return HeaderBuilder
     */
    public function setServices(array $services): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @throws \Exception
     *
     * @return array
     */
    public function getServices(): array
    {
        $services = [];
        foreach ($this->services as $service) {
            $services[] = $this->container->get($service);
        }

        return $services;
    }
}
