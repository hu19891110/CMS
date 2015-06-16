<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();

            $table->string('item_type')->default('custom');
            $table->integer('item_id')->nullable();

            $table->json('options')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('total',6,2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_items');
    }
}
