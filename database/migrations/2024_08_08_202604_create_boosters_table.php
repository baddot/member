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
        Schema::create('boosters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('value'); // Duration in seconds or percentage
            $table->decimal('price', 15, 2); // Price in USDT
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boosters');
    }

};
