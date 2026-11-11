<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom role sudah tersedia di database Supabase.
    }

    public function down(): void
    {
        // Tidak menghapus kolom role.
    }
};