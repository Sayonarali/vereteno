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
        Schema::create('product_vendor_code_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_vendor_code_id');
            $table->foreign('product_vendor_code_id')
                ->references('id')->on('product_vendor_codes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('size_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor_code_sizes');
    }
};
