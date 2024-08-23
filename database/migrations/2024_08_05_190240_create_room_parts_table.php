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
        Schema::create('room_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('material_id')->nullable();
            $table->text('name')->nullable();
            $table->text('color')->nullable();
            $table->integer('count')->nullable();
            $table->decimal('thickness',15, 4)->nullable();
            $table->decimal('height',15, 4)->nullable();
            $table->decimal('width',15, 4)->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_parts');
    }
};
