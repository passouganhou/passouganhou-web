<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings as SpatieSettings;

class GeneralSettings extends SpatieSettings
{
    public string $whatsapp;

    public static function group(): string
    {
        return 'general';
    }
}
