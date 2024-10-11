<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('reservations');
    }
    
    public function down()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Add other columns if you want the down method to restore the table
        });
    }
    
};
