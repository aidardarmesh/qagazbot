<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id');
            $table->integer('client_id');
            $table->string('filename');
            $table->text('url');
            $table->integer('pages');
            $table->double('size', 4, 2);
            $table->integer('auth_code')->nullable($value = true);
            $table->integer('terminal_id')->nullable($value = true);
            $table->timestamp('printed_at')->nullable($value = true);
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
        Schema::dropIfExists('orders');
    }
}
