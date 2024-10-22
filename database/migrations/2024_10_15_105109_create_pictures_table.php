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
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Fixed foreign key
            $table->string('path_to_img');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
