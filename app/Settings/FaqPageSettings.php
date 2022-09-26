<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Spatie\LaravelSettings\Settings as SpatieSettings;

class FaqPageSettings extends SpatieSettings
{
    public array $maquininhas;

    public static function group(): string
    {
        return 'faq';
    }
}
