<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateFaqSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('faq.maquininhas', []);
    }
}
