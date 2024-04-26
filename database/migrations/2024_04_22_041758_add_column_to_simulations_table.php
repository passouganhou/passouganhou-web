<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('simulacaos', function (Blueprint $table) {
            $table->string("deal_name")->nullable();
            $table->string("deal_organization_name")->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('simulacaos', function (Blueprint $table) {
            //
        });
    }
};
