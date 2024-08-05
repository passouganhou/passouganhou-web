<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gsurf_transactions', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->dateTime('date');
            $table->string('nsu_sitef', 50);
            $table->string('merchant_code_sitef', 50);
            $table->string('merchant_code_subacquirer', 50)->nullable();
            $table->string('response_code', 10);
            $table->string('authorization_code', 50);
            $table->string('fiscal_coupon', 50)->nullable();
            $table->integer('installments_number')->nullable();
            $table->string('terminal_number', 50);
            $table->string('channel', 50);
            $table->string('nsu_host', 50);
            $table->string('entry_mode', 50)->nullable();
            $table->string('logic_number', 50);
            $table->dateTime('fiscal_date')->nullable();
            $table->string('customer_id', 50)->nullable();
            $table->dateTime('import_date')->nullable();
            $table->string('type', 50);
            $table->date('transaction_date');
            $table->integer('reconciliation_status')->nullable();
            $table->dateTime('export_date')->nullable();
            $table->string('original_authorization_code', 50)->nullable();
            $table->integer('original_installments_number')->nullable();
            $table->string('order_id')->nullable();
            $table->string('merchant_usn')->nullable();
            $table->string('nit')->nullable();
            $table->string('gsetef_merchant_id')->nullable();
            $table->string('uuid', 255);
            $table->string('reconciliation_nsu', 50)->nullable();
            $table->dateTime('reconciliation_date')->nullable();
            $table->text('dynamic_data')->nullable();
            $table->text('split_data')->nullable();
            $table->string('original_transaction_usn')->nullable();
            $table->integer('status_id');
            $table->string('status_description', 50);
            $table->integer('original_status_id');
            $table->string('original_status_description', 50);
            $table->integer('transaction_type_id');
            $table->string('transaction_type_description', 50);
            $table->integer('card_brand_id');
            $table->string('card_brand_description', 50);
            $table->integer('acquirer_id');
            $table->string('acquirer_description', 50);
            $table->integer('category_id');
            $table->string('category_description', 50);
            $table->integer('status_category_id');
            $table->string('status_category_description', 50);
            $table->integer('sale_type_id')->nullable();
            $table->string('sale_type_description', 50)->nullable();
            $table->integer('amount');
            $table->string('amount_currency', 10);
            $table->integer('original_amount');
            $table->string('original_amount_currency', 10);
            $table->string('response_code_detailing_category', 50);
            $table->string('response_code_detailing_reason', 50);
            $table->text('response_code_detailing_note')->nullable();
            $table->string('antifraud_data_code')->nullable();
            $table->text('antifraud_data_reviewer_comments')->nullable();
            $table->string('antifraud_data_category')->nullable();
            $table->string('antifraud_data_reason')->nullable();
            $table->text('antifraud_data_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gsurf_transactions');
    }
};
