<?php

namespace Bitcodesa\NovaLabel\Commands;

use App\Providers\GoogleTranslate;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Schema;

class MakeLabel extends GeneratorCommand
{
    protected $signature = 'make:label {name} {lang}';

    protected $description = 'Create new model labels';

    protected $type = "Lang";

    protected function buildClass($name)
    {
        $label = Str::snake(Str::plural(class_basename($name)));
        $singular_label = Str::snake(class_basename($name));

        $columns = [];
        if (Schema::hasTable($label)) {
            $columns = Schema::getColumnListing($label);
        }

        if ($label == $singular_label) {
            $label .= "_plural";
        }

        $attributes = "[]";

        if (count($columns)) {
            $attributes = "[\n";
            foreach ($columns as $column) {
                if ($this->generalAttribute($column)) {
                    $attributes .= "\t\t\"$column\" => __(\"$column\"),\n";
                } else {
                    $attributes .= "\t\t\"$column\" => \"" .
                        Str::headline($column) .
                        "\",\n";
                }
            }
            $attributes .= "\t]";
        }

        $replace = [
            '{{ label }}' => $label,
            '{{ label_trans }}' => Str::headline($label),
            '{{ singularLabel_trans }}' => Str::headline($singular_label),
            '{{ singularLabel }}' => $singular_label,
            '{{ create }}' => "create " . Str::headline($singular_label),
            '{{ update }}' => "update " . Str::headline($singular_label) . " data",
            '{{ created }}' =>
                Str::headline($singular_label) . " was created successfully",
            '{{ updated }}' =>
                Str::headline($singular_label) . " has been updated successfully",
            '{{ deleted }}' =>
                Str::headline($singular_label) . " has been deleted successfully",
            '{{ not_founded }}' => Str::headline($singular_label) . " not found",
            '{{ attributes }}' => $attributes
        ];

        $result = str_replace(array_keys($replace), array_values($replace), parent::buildClass($name));

        return $result;
    }

    public function getStub()
    {
        return __DIR__.'/stubs/labels.stub';
    }

    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel->langPath($this->argument('lang')) . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function generalAttribute($attribute)
    {
        return array_search($attribute, [
                "created_at",
                "updated_at",
                "deleted_at",
                "id"
            ]) !== false;
    }
}
