<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function detail_alternatif()
    {
        return $this->hasMany(DetailAlternatif::class, 'id_kriteria', 'id_kriteria');
    }

    public function bobot()
    {
        return $this->hasMany(BobotKriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
