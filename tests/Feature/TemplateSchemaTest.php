<?php

use CubeAgency\FilamentTemplate\Forms\Components\Template;
use CubeAgency\FilamentTemplate\Tests\Fixtures\Templates\BlogTemplate;
use CubeAgency\FilamentTemplate\Tests\Fixtures\Templates\EmptyTemplate;

it('has no child components by default', function () {
    expect(Template::make('content')->getDefaultChildComponents())->toBe([]);
});

it('registers the template fields as child components', function () {
    $field = Template::make('content')->template(new BlogTemplate);

    $names = array_map(
        fn ($component) => $component->getName(),
        $field->getDefaultChildComponents(),
    );

    expect($names)->toBe(['title', 'description']);
});

it('is visible when the template has fields', function () {
    $field = Template::make('content')->template(new BlogTemplate);

    expect($field->isVisible())->toBeTrue()
        ->and($field->isHidden())->toBeFalse();
});

it('is hidden when the template has no fields', function () {
    $field = Template::make('content')->template(new EmptyTemplate);

    expect($field->isHidden())->toBeTrue()
        ->and($field->isVisible())->toBeFalse();
});
