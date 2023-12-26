# Create Labels for Nova Resources with different languages.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abather/nova-label.svg?style=flat-square)](https://packagist.org/packages/abather/nova-label)
[![Total Downloads](https://img.shields.io/packagist/dt/abather/nova-label.svg?style=flat-square)](https://packagist.org/packages/abather/nova-label)

~~**Dynamically Manage Labels for Nova Resources**

This document details how to dynamically manage labels for Nova resources using the `bitcodesa/nova-label` package.

## Installation

Install the package using Composer:

```bash
composer require abather/nova-label
```

## Usage

1. **Include ResourceLabel**:

In `App/Nova/Resource.php`, extend the `NovaResource` class and add the `ResourceLabel` trait:

```php
<?php

namespace App\Nova;

use Bitcodesa\NovaLabel\ResourceLabel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    use ResourceLabel;

    // ...
}
```

2. **Generate Labels**:~~

Use the `self::attribute()` method to generate field labels. This method handles both field name and database attribute:

```php
Text::make(...self::attribute('name')); // field name and attribute same
```

**Optional Parameters:**

* **Attribute name:**

Specify a different database attribute name:

```php
Text::make(...self::attribute('name', 'fullName')); // field name: name, attribute: fullName
```

* **Title only:**

Return only the attribute title:

```php
Text::make(self::attribute('name', title_only: true));
```

3. **Handle Relationships:**

For relationship fields, pass the corresponding resource class as the first parameter to `self::relation()`:

```php
BelongsTo::make(...self::relation(\App\Nova\User::class, many: false)); // One-to-one relationship
```

**Relationship Label Customization:**

Similar to field labels, you can customize relationship labels with `title` and `relation` parameters:

```php
HasMany::make(...self::relation(\App\Nova\Task::class, title: "Tasks", relation: "tasks"));
```

**Change File Name:**

you can change file name for any resource by override `getLangPath()` function:

```php
public static function getLangPath()
{
    return "Users";
}
```

**Change Resource Name:**

you can change file name for any resource by override `getLangName()` function:

```php
public static function getLangName()
{
    return "Admin";
}
```

## Localization

### File Structure

Each resource has a dedicated localization file for field and other translations. The file structure should follow:

```php
<?php

return [
    // Resource name in singular and plural form
    "resource" => "Resource",
    "resources" => "Resources",

    // Button labels
    "buttons" => [
        "create" => "Create Resource",
        "update" => "Update Resource",
    ],

    // Attributes
    "attributes" => [
        // Translate each attribute name
        "created_at" => __("created_at"),
        // ...
    ],

    // Additional sections (optional)
];
```

### Create Localization Files

To create a new localization file for a specific resource and language:

```bash
php artisan make:label ResourceName LanguageSample
```

For example, to create an Arabic translation file for the `Book` resource:

```bash
php artisan make:label Book ar
```

This command generates a file at `Lang/ar/Book.php`. Translate each line in the file according to your needs.

**Note:** Run `php artisan migrate` before creating the localization file to ensure all column names are available for
translation.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Abather M.S](https://github.com/abather)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
