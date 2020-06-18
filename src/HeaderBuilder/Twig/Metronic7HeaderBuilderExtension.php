<?php

declare(strict_types=1);

namespace Randock\Metronic7Bundle\HeaderBuilder\Twig;

use Randock\Metronic7Bundle\HeaderBuilder\HeaderBuilder;

class Metronic7HeaderBuilderExtension extends \Twig_Extension
{
    /**
     * @var HeaderBuilder
     */
    private HeaderBuilder $headerBuilder;

    public function __construct(HeaderBuilder $headerBuilder)
    {
        $this->headerBuilder = $headerBuilder;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('getHeaderLists', [$this->headerBuilder, 'getServices']),
        ];
    }
}
