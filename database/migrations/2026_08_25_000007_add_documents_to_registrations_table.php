<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('japanese_level');
            $table->string('ktp')->nullable()->after('photo');
            $table->string('ijazah')->nullable()->after('ktp');
        });
    }

    public function down(): void {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['photo', 'ktp', 'ijazah']);
        });
    }
};
