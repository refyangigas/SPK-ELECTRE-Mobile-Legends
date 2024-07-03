<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;
    protected $table = 'subkriteria';
    protected $primaryKey = 'id_subkriteria';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function data_kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function detail_alternatif()
    {
        return $this->hasMany(DetailAlternatif::class, 'id_subkriteria', 'id_subkriteria');
    }
}
