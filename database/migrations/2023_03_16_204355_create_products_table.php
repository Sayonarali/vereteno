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
        Schema::create('products', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->foreignId('category_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('discount_id')->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('vendor_code_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->float('price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
