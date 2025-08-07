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
        Schema::create('customer_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('activity')->nullable(); 
            $table->string('unit_price')->nullable(); 
            $table->string('deposite')->nullable(); 
            $table->date('quarterly_installments_start_from_the_date')->nullable();  
            $table->text('notes')->nullable();
            $table->tinyInteger('user_id')->nullable(); 
            $table->tinyInteger('employee_id')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_logs');
    }
};
