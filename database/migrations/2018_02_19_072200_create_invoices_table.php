<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('price');
            $table->timestamp('confirmed')->nullable($value = true);
            $table->string('error')->nullable($value = true);
            $table->string('card')->nullable($value = true);
            $table->double('amount', 8, 2)->nullable($value = true);
            $table->integer('currency')->nullable($value = true);
            $table->string('response_code')->nullable($value = true);
            $table->string('approval_code')->nullable($value = true);
            $table->string('reference')->nullable($value = true);
            $table->timestamp('approved')->nullable($value = true);
            $table->string('approve_error')->nullable($value = true);
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
        Schema::dropIfExists('invoices');
    }
}
