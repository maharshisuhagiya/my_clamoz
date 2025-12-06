<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            
            $table->integer('user_id')->default(0);

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('relationship')->nullable();

            $table->string('tax_id_type')->nullable();   // SSN, ITIN, ATIN
            $table->string('occupation')->nullable();
            $table->string('visa_type')->nullable();

            $table->date('first_port_entry_date')->nullable();

            $table->integer('days_2025')->nullable();
            $table->integer('days_2024')->nullable();
            $table->integer('days_2023')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dependents');
    }
};
