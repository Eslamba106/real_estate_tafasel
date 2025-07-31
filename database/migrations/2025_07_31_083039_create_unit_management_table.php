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
        Schema::create('unit_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('floor_management_id')->constrained('floor_management')->cascadeOnDelete();
            $table->string('name');
            $table->foreignId('unit_description_id')->nullable()->constrained('unit_descriptions')->cascadeOnDelete();
            $table->foreignId('unit_condition_id')->nullable()->constrained('unit_conditions')->cascadeOnDelete();
            $table->foreignId('unit_type_id')->nullable()->constrained('unit_types')->cascadeOnDelete();
            $table->foreignId('unit_parking_id')->nullable()->constrained('unit_parkings')->cascadeOnDelete();
            $table->foreignId('view_id')->nullable()->constrained('views')->cascadeOnDelete();
            $table->string('price')->nullable();
            $table->string('room_counts')->nullable();
            $table->string('bath_room_counts')->nullable();
            $table->string('ratio')->nullable();
            $table->string('area')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('booking_status', ['empty', 'request', 'review', 'meeting', 'booking', 'agreement'])->default('empty');
            $table->string('branch_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_management');
    }
};
