<?php

namespace CubeAgency\FilamentTemplate\Tests\Fixtures\Templates;

use CubeAgency\FilamentTemplate\FilamentTemplate;
use Filament\Forms\Components\TextInput;

class BlogTemplate extends FilamentTemplate
{
    public function schema(): array
    {
        return [
            TextInput::make('title'),
            TextInput::make('description'),
        ];
    }
}
