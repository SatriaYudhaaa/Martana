<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('booking_transactions')) {
            Schema::create('booking_transactions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('customer_name');
                $table->string('phone', 20);
                $table->date('booking_date');
                $table->decimal('total_price', 12, 2)->default(0);
                $table->string('status')->default('pending');
                $table->string('payment_method')->nullable();
                $table->string('proof_transfer')->nullable();
                $table->timestamp('expires_at')->nullable();
                $table->timestamps();

                $table->index(['booking_date', 'status']);
            });
        }

        if (Schema::hasTable('bookings') && !Schema::hasColumn('bookings', 'transaction_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreignId('transaction_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('booking_transactions')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('bookings') && Schema::hasColumn('bookings', 'transaction_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropConstrainedForeignId('transaction_id');
            });
        }

        Schema::dropIfExists('booking_transactions');
    }
};
