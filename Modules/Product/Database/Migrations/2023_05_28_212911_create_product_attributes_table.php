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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('size_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('color_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('material_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->string('article')->unique();
            $table->float('price');
            $table->integer('in_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
