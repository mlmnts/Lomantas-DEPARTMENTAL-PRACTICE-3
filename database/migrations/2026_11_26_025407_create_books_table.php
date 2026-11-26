<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        // Foreign key: the administrator who created this book
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->string('author');
        $table->string('category');
        $table->decimal('unit_price', 10, 2);
        $table->text('description');
        $table->string('availability_status')->default('Available');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
