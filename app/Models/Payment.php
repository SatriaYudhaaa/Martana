<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'id_pembayaran';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_booking',
        'id_penjaga',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'total_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_verifikasi',
        'verified_at',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'total_pembayaran' => 'decimal:2',
        'verified_at' => 'datetime',
    ];
}
