<?php

namespace CubeAgency\FilamentTemplate\Forms\Components;

use CubeAgency\FilamentTemplate\FilamentTemplate;
use Filament\Forms\Components\Field;

class Template extends Field
{
    protected string $view = 'filament-forms::components.fieldset';

    protected function setUp(): void
    {
        parent::setUp();

        $this->columnSpan('full');
    }

    public function template(FilamentTemplate $template): self
    {
        $this->schema($template->schema())->visible(count($template->schema()));

        return $this;
    }
}