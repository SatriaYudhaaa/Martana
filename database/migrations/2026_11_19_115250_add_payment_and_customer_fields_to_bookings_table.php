
<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom user_id, payment_method, dan proof_transfer
        // sudah tersedia di database Supabase.
    }

    public function down(): void
    {
        // Tidak menghapus kolom karena sudah digunakan
        // oleh database dan mungkin migration lain.
    }
};