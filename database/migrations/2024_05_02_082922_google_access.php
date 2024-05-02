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
      Schema::create('google_access',function (Blueprint $table){
          $table->id()->autoIncrement();
          $table->unsignedBigInteger('user_id');
          $table->json('payload')->nullable();
          $table->string('tk')->nullable();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_access');
    }
};