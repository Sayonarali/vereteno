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
        Schema::create('product_vendor_code_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_vendor_code_id')->constrained();
            $table->integer('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor_code_feedbacks');
    }
};