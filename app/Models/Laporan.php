<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $fillable = [
        'uploaded_by',
        'judul',
        'jenis_laporan',
        'keterangan',
        'file_path',
    ];

    public function penjaga(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }
}
