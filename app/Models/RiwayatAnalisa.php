<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAnalisa extends Model
{
    use HasFactory;
    protected $table = 'riwayat_analisa';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function analisa()
    {
        return $this->belongsTo(Analisa::class, 'id_analisa', 'id_analisa');
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }
}