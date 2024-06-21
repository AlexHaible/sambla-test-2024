<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employees extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('ssn');
            $table->string('phone');
            $table->string('firstName');
            $table->string('lastName');
            $table->date('dob');
            $table->decimal('salary', 15, 2);
            $table->date('employmentFrom');
            $table->date('employmentTo')->nullable();
            $table->boolean('currentlyWorking');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
