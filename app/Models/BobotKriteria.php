<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    use HasFactory;
    protected $table = 'bobot_kriteria';
    protected $primaryKey = 'id_bobot_kriteria';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function gameplay()
    {
        return $this->belongsTo(GameplayType::class, 'id_gameplay', 'id_gameplay');
    }
}