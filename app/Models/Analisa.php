<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisa extends Model
{
    use HasFactory;
    protected $table = 'analisa';
    protected $primaryKey = 'id_analisa';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function gameplay()
    {
        return $this->belongsTo(GameplayType::class, 'id_gameplay', 'id_gameplay');
    }

    public function riwayat_analisa()
    {
        return $this->hasMany(RiwayatAnalisa::class, 'id_analisa', 'id_analisa');
    }
}
