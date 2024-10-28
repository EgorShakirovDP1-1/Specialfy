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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('model');
            $table->integer('year');
            $table->string('filmname');
            $table->integer('genre');
            $table->integer('description');
            $table->float('price_per_subscribtion');
            $table->float('price_per_watch');
            $table->string('filmImage1');
            $table->string('filmImage2')->nullable();
            $table->string('filmImage3')->nullable();
            $table->string('filmImage4')->nullable();
            $table->string('filmImage5')->nullable();
            $table->string('filmImage6')->nullable();
            $table->string('filmImage7')->nullable();
            $table->string('filmImage8')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
