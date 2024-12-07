<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->timestamp('order_date')->useCurrent();
            $table->enum('status', ['Pending', 'Processing', 'Delivered', 'Cancelled'])->default('Pending');
            $table->string('address');
            $table->foreignId('delivery_person_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
