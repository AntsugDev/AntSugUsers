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
       Schema::create('task_project_group',function (Blueprint $table){
           $table->id()->autoIncrement();
           $table->string('name')->unique();
           $table->unsignedBigInteger('user_id')->nullable();
           $table->foreign('user_id','fk_user_project_task')->references('id')->on('users');
           $table->timestamps();
           $table->softDeletes();

       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_project_group');
    }
};
