
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guard_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guard_id')
                ->constrained('admins')
                ->cascadeOnDelete();

            $table->date('attendance_date');

            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();

            $table->string('status', 20)->default('hadir');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['guard_id', 'attendance_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guard_attendances');
    }
};