<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('receiver_name')->nullable();
            $table->text('phone')->nullable();
            $table->longText('note')->nullable();
            $table->text('task_id')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('delivery_date')->nullable(); // Correct usage
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('workshop_id')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
