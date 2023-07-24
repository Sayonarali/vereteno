<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_vendor_code_images', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('images');
            $table->string('path');
            $table->string('title');
            $table->foreignId('product_vendor_code_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->integer('size')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor_code_images');
    }
};
