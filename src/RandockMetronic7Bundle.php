<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Randock\Metronic7Bundle\DependencyInjection\Compiler\MenuPass;
use Randock\Metronic7Bundle\DependencyInjection\Compiler\HeaderListPass;

class RandockMetronic7Bundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new MenuPass());
        $container->addCompilerPass(new HeaderListPass());
    }
}
