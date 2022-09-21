<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('date');
            $table->string('invoice_number');
            $table->string('table_number');
            $table->string('total_amount');
            $table->string('paid_amount');
            $table->string('discount_amount')->nullable();
            $table->string('paid_status')->nullable();
            $table->string('delivery_charge')->nullable();
            $table->string('cus_contact_number')->nullable();
            $table->string('customer_points')->nullable();
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
