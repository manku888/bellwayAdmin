<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no', 15);
            $table->text('current_location');
            $table->decimal('current_ctc', 10, 2)->nullable();
            $table->string('notice_period');
            $table->string('total_experience');
            $table->text('resume_link');
            $table->enum('selected_role', ['Developer', 'Tester', 'Manager', 'Designer', 'Other'])->nullable(); // Dropdown field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
}

