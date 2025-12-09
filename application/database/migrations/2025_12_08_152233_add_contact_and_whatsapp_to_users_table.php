<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // already 'phone' column che, etle contact number eni andar mukisu
            // country codes & whatsapp mate new columns
            $table->string('contact_country_code', 10)->nullable()->after('phone');
            $table->string('whatsapp_number')->nullable()->after('contact_country_code');
            $table->string('whatsapp_country_code', 10)->nullable()->after('whatsapp_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'contact_country_code',
                'whatsapp_number',
                'whatsapp_country_code',
            ]);
        });
    }
};
