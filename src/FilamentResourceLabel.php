<?php

namespace Bitcodesa\NovaLabel;

use Illuminate\Support\Str;

trait FilamentResourceLabel
{
    public static function lang($path, $variables = []): string
    {
        return __(self::getLangPath().".$path", $variables);
    }

    public static function getPluralModelLabel(): string
    {
        if (Str::snake(Str::plural(self::getLangName())) == Str::snake(self::getLangName())) {
            return self::lang(Str::snake(self::getLangName()).'_plural');
        }

        return self::lang(Str::snake(Str::plural(self::getLangName())));
    }

    public static function getModelLabel(): string
    {
        return self::lang(Str::snake(self::getLangName()));
    }

    public static function attribute(string $title, $attribute = null, $title_only = false): array|string
    {
            return self::lang("attributes.".Str::snake($title));
    }

    public static function getLangPath()
    {
        return self::getLangName();
    }

    public static function getLangName()
    {
        return class_basename(static::$model);
    }
}
