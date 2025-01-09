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
        Schema::create('open_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_no', 15);
            $table->string('email');
            $table->string('service');
            $table->text('resume_link');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_vacancies');
    }
};
