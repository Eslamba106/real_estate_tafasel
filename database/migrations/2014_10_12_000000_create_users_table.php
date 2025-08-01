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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable(); 
            $table->string('username')->unique(); 
            $table->tinyInteger('role_id')->nullable();
            $table->string('password'); 
            $table->string('status')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->string('my_name')->nullable(); 
            $table->integer('branch_id')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
