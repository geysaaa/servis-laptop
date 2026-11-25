<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $table = 'servis';

    protected $fillable = [
        'kode_tiket', 'nama_pelanggan', 'no_wa', 'merk_tipe', 'keluhan',
        'kelengkapan', 'tgl_diterima', 'tgl_selesai', 'harga', 'status', 'dibuat_oleh',
    ];

    protected $casts = [
        'tgl_diterima' => 'date',
        'tgl_selesai' => 'date',
    ];

    public const STATUS = ['Diterima', 'Diperiksa', 'Dikerjakan', 'Selesai', 'Sudah Diambil'];

    public function riwayat()
    {
        return $this->hasMany(RiwayatStatus::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}