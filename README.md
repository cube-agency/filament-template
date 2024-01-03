# Template field for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cube-agency/filament-template.svg?style=flat-square)](https://packagist.org/packages/cube-agency/filament-template)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cube-agency/filament-template/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cube-agency/filament-template/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cube-agency/filament-template/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cube-agency/filament-template/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cube-agency/filament-template.svg?style=flat-square)](https://packagist.org/packages/cube-agency/filament-template)

Template field for Filament, that gives an option to have different fields based on field value or type in one Resource.

## Installation

You can install the package via composer:

```bash
composer require cube-agency/filament-template
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-template-config"
```

## Usage

Add "template" column to your Model/table
```php
$table->string('template');
```

Create your template by using console command:

```php
php artisan filament-template:create Blog
```

Add it to config

```php
return [
    'templates' => [
        \App\Filament\Templates\BlogTemplate::class,
    ]
];
```

At this moment, this could be used by passing url parameter (query string) to create form

```php
class CreatePage extends CreateRecord
{
    public $template;

    protected $queryString = ['template'];
}
```

and adding this in your Resource

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            Hidden::make('template')
                ->default($this->getTemplate()),
            Template::make('content')
                ->template($this->resolveTemplate()),
        ]);
}

protected function resolveTemplate()
{
    return app($this->getTemplate());
}

protected function getTemplate()
{
    if (property_exists($this, 'template')) {
         return $this->template;
    }

    return $this->getRecord()->getAttribute('template');
}
```

Override create action to show modal with template select

```php
public function getActions(): array
{
    return [
        Action::make('create')
            ->form($this->actionForm())
            ->action(function (array $data): void {
                $parameters = http_build_query($data);
    
                $this->redirect(static::$resource::getUrl('create') . '?' . $parameters);
            })
    ];
}

protected function getTemplates(): Collection
{
    return collect(config('filament-template.templates'))->mapWithKeys(function ($template) {
        $templateName = explode('\\', $template);
        return [$template => end($templateName)];
    });
}

protected function actionForm(): array
{
    return [
        Select::make('template')
            ->label('Template')
            ->options($this->getTemplates())
            ->required(),
    ];
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dmitrijs Mihailovs](https://github.com/dmitrijs.mihailovs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
