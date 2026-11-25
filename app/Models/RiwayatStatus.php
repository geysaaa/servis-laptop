<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_status';
    public $timestamps = false;

    protected $fillable = ['servis_id', 'status', 'waktu', 'diubah_oleh'];

    protected $casts = ['waktu' => 'datetime'];

    public function servis()
    {
        return $this->belongsTo(Servis::class);
    }

    public function pengubah()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }
}
