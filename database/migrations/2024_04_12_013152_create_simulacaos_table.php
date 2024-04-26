<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('simulacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('negociacao_id')->nullable();
            $table->string('vendedor_id')->nullable();
            $table->integer('mcc');
            $table->integer('pontos_venda');
            $table->integer('maquinas');
            $table->decimal('faturamento_mensal');
            $table->decimal('ticket_medio');
            $table->decimal('share_debito');
            $table->decimal('share_credito');
            $table->decimal('share_2_6');
            $table->decimal('share_7_12');
            $table->json('prop_visa_master');
            $table->json('prop_elo_amex');
            $table->decimal('prop_antecipacao');
            $table->decimal('prop_aluguel');
            $table->boolean('opt_antecipacao')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulacaos');
    }
};
