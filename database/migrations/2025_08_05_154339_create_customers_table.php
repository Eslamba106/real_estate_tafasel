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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('budget')->nullable();
            $table->string('job')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('floor_id')->nullable(); 
            $table->integer('added_by')->nullable(); 
            $table->integer('assign_to_team')->nullable(); 
            $table->integer('assign_to')->nullable(); 
            $table->date('assign_date')->nullable(); 
            $table->integer('status')->default(1);
            $table->enum('booking_status', ['empty', 'request', 'review', 'meeting', 'booking', 'agreement'])->default('empty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
