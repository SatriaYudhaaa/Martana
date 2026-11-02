
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('id_pembayaran', 15)->primary();

            // Mengikuti rancangan SDD: id booking berupa VARCHAR(15).
            // Foreign key ditambahkan setelah skema booking tim dipastikan.
            $table->string('id_booking', 15)->unique();
            $table->string('id_penjaga', 15)->nullable();

            $table->date('tanggal_pembayaran')->nullable();
            $table->string('metode_pembayaran', 20);
            $table->decimal('total_pembayaran', 10, 2);

            $table->string('status_pembayaran', 30)
                ->default('menunggu_verifikasi');

            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
