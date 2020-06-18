<?php

declare(strict_types=1);

namespace Randock\MetronicBundle\HeaderBuilder\Twig;

use Randock\Metronic7Bundle\HeaderBuilder\HeaderBuilder;

class MetronicHeaderBuilderExtension extends \Twig_Extension
{
    private HeaderBuilder $headerBuilder;

    public function __construct(HeaderBuilder $headerBuilder)
    {
        $this->headerBuilder = $headerBuilder;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getHeaderLists', [$this->headerBuilder, 'getServices']),
        ];
    }
}
