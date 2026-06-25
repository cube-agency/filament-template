<?php

namespace CubeAgency\FilamentTemplate\Tests\Fixtures\Templates;

use CubeAgency\FilamentTemplate\FilamentTemplate;

class EmptyTemplate extends FilamentTemplate
{
    public function schema(): array
    {
        return [];
    }
}
