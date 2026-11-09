
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guard_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guard_id')
                ->constrained('admins')
                ->cascadeOnDelete();

            $table->string('day_of_week', 15);
            $table->time('start_time');
            $table->time('end_time');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['guard_id', 'day_of_week']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guard_schedules');
    }
};