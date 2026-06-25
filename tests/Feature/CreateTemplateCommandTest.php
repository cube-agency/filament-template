<?php

use Illuminate\Support\Facades\File;

afterEach(function () {
    File::deleteDirectory(app_path('Filament'));
});

it('generates a template class from the stub', function () {
    $this->artisan('filament-template:create', ['name' => 'Blog'])
        ->assertSuccessful();

    $path = app_path('Filament/Templates/BlogTemplate.php');

    expect(File::exists($path))->toBeTrue();

    expect(File::get($path))
        ->toContain('namespace App\Filament\Templates;')
        ->toContain('use CubeAgency\FilamentTemplate\FilamentTemplate;')
        ->toContain('class BlogTemplate extends FilamentTemplate');
});

it('supports nested namespaces', function () {
    $this->artisan('filament-template:create', ['name' => 'Nested/Post'])
        ->assertSuccessful();

    $path = app_path('Filament/Templates/Nested/PostTemplate.php');

    expect(File::exists($path))->toBeTrue();

    expect(File::get($path))
        ->toContain('namespace App\Filament\Templates\Nested;')
        ->toContain('class PostTemplate extends FilamentTemplate');
});
