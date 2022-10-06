<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.whatsapp', 'https://api.whatsapp.com/send/?phone=556196044061&text=Ol%C3%A1%2C+gostaria+de+saber+mais+sobre+a+Passou+Ganhou.&type=phone_number&app_absent=0');
    }
}
