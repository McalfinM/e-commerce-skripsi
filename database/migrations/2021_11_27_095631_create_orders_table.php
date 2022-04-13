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
            $table->string('order_number');
            $table->unsignedBigInteger('user_id')->index();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->string('pic_name')->nullable();
            $table->enum('status', ['Order Created', 'Request Price', 'Bidding', 'Processed', 'Order Ready', 'Company Deal', 'Deal', 'Done']);
            $table->string('surat_jalan')->nullable();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
