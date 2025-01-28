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
    // Migration file for lead_histories table
public function up()
{
    Schema::create('lead_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('lead_id');
        $table->string('assignee')->nullable();
        $table->string('service')->nullable();
        $table->string('status')->nullable();
        $table->string('source')->nullable();
        $table->string('budget')->nullable();
        $table->string('full_name')->nullable();
        $table->string('phone_number')->nullable();
        $table->string('city')->nullable();
        $table->string('email')->nullable();
        $table->text('description')->nullable();
        $table->dateTime('last_follow_up_date')->nullable();
        $table->timestamp('follow_up_date')->nullable();
        $table->timestamps();

        // Foreign key constraint (optional)
        $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_histories');
    }
};
