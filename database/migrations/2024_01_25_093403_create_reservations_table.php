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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',100);
            $table->datetime('reservation_date');
            $table->integer('duration_minute');
            $table->foreignId('dining_table_id')->constrained('dining_tables');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_walkin')->default(0);            
            $table->boolean('is_cancel')->default(0);
            $table->datetime('canceled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
