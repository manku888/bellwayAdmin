<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('assignee')->nullable();
            $table->string('source')->nullable();
            $table->string('service')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('created_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Default current date & time
            $table->string('budget')->nullable();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('last_follow_up_date')->nullable();
            $table->dateTime('follow_up_date')->nullable();
            $table->timestamps(); // Automatically saves `created_at` and `updated_at`
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
