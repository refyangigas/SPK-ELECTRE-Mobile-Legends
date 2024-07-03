<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function detail_alternatif()
    {
        return $this->hasMany(DetailAlternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function riwayat_analisa()
    {
        return $this->hasMany(RiwayatAnalisa::class, 'id_alternatif', 'id_alternatif');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}