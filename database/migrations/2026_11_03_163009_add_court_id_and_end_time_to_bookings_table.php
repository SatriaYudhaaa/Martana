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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('court_id')
                ->after('id')
                ->constrained('courts')
                ->cascadeOnDelete();

            $table->time('end_time')->after('start_time');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['court_id']);
            $table->dropColumn(['court_id', 'end_time']);
        });
}};
