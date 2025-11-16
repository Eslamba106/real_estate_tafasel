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
        Schema::table('unit_management', function (Blueprint $table) { 
            $table->double('installment')->after('price')->nullable();
            $table->tinyInteger('payment_mode')->after('installment')->nullable();
            $table->double('cash')->after('payment_mode')->nullable();
            $table->double('down_payment')->after('cash')->nullable();
            $table->double('maintenance')->after('down_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_management', function (Blueprint $table) {
            $table->dropColumn(['installment', 'payment_mode', 'cash', 'down_payment', 'maintenance']);
        });
    }
};
