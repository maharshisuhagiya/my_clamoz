<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('spouses', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->default(0);

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->date('dob')->nullable();
            $table->string('gender')->nullable();

            $table->string('tax_id_type')->nullable(); // SSN / ITIN / ATIN
            $table->string('occupation')->nullable();
            $table->string('visa_type')->nullable();
            $table->date('first_port_entry_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouses');
    }
};
