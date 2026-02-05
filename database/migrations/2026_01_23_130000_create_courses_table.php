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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->default('يوجد مشكلة');
            $table->string('name_en')->default('There is a problem');
            $table->string('description_ar');
            $table->string('description_en');
            $table->decimal('price', 8, 2);
            $table->decimal('duration_hours',5,2)->default(0);
            $table->enum('level', ['مبتدئ', 'متوسط', 'متقدم'])->default('مبتدئ');
            $table->string('thumbnail_url');
            $table->string('video_url');
            $table->foreignId('Author_id')->constrained('authers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
