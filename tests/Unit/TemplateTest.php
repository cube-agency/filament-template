<?php

use CubeAgency\FilamentTemplate\Forms\Components\Template;
use Filament\Forms\Components\Field;

it('is a filament field', function () {
    expect(Template::make('content'))->toBeInstanceOf(Field::class);
});

it('keeps the field name', function () {
    expect(Template::make('content')->getName())->toBe('content');
});

it('renders through the fieldset view', function () {
    expect(Template::make('content')->getView())->toBe('filament-template::components.fieldset');
});

it('spans the full column width', function () {
    expect(Template::make('content')->getColumnSpan('lg'))->toBe('full');
});
