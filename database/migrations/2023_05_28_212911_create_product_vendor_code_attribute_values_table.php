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
        Schema::create('product_vendor_code_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_vendor_code_id');
            $table->foreign('product_vendor_code_id', 'product_vendor_code_attribute_values_id')
                ->references('id')->on('product_vendor_codes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('attribute_value_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor_code_attribute_values');
    }
};
