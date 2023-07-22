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
        Schema::create('product_vendor_code_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_vendor_code_id')
                ->constrained();
            $table->foreignId('attribute_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor_code_attributes');
    }
};
