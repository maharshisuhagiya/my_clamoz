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
        Schema::create('taxpayers', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->default(0);

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('ssn_itin')->nullable();
            $table->string('occupation')->nullable();

            $table->date('dob')->nullable();
            $table->string('gender')->nullable();

            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alt_mobile')->nullable();
            $table->string('street')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip')->nullable();

            $table->string('visa_type')->nullable();
            $table->string('current_employer')->nullable();
            $table->string('filing_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxpayers');
    }
};
