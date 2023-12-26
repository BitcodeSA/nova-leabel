<?php

namespace Bitcodesa\NovaLabel;

use Illuminate\Support\Str;

trait ResourceLabel
{
    public static function lang($path, $variables = []): string
    {
        return __(self::getLangPath().".$path", $variables);
    }

    public static function label()
    {
        if (Str::snake(Str::plural(self::getLangName())) == Str::snake(self::getLangName())) {
            return self::lang(Str::snake(self::getLangName()).'_plural');
        }

        return self::lang(Str::snake(Str::plural(self::getLangName())));
    }

    public static function singularLabel()
    {
        return self::lang(Str::snake(self::getLangName()));
    }

    public static function createButtonLabel(): string
    {
        return self::lang("buttons.create");
    }

    public static function updateButtonLabel(): string
    {
        return self::lang("buttons.update");
    }

    public static function attribute(string $title, $attribute = null, $title_only = false): array|string
    {
        if ($title_only) {
            return self::lang("attributes.".Str::snake($title));
        }

        return [
            self::lang("attributes.".Str::snake($title)),
            $attribute ?? Str::snake($title)
        ];
    }

    public function relation($resource, $many = true, $relation = null, $title = null): array
    {
        if ($many) {
            $title = $title ?? $resource::label();
            $relation = $relation ?? Str::camel(Str::plural($resource::getLangName()));
        } else {
            $title = $title ?? $resource::singularLabel();
            $relation = $relation ?? Str::camel($resource::getLangName());
        }

        return [
            $title,
            $relation,
            $resource
        ];
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
