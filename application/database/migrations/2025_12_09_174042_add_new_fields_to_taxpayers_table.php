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
        Schema::table('taxpayers', function (Blueprint $table) {
            $table->string('city')->nullable()->after('street');
            $table->string('country_of_citizenship')->nullable()->after('country');
            $table->date('first_port_entry_date')->nullable()->after('country_of_citizenship');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taxpayers', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'country_of_citizenship',
                'first_port_entry_date',
            ]);
        });
    }
};
