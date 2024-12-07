<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('delivery_person_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['Assigned', 'Out for Delivery', 'Delivered'])->default('Assigned');
            $table->timestamp('delivery_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_details');
    }
}
