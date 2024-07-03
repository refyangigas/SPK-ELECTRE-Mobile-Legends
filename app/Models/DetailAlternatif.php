<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlternatif extends Model
{
    use HasFactory;
    protected $table = 'detail_alternatif';
    protected $primaryKey = 'id_detail_alternatif';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria', 'id_subkriteria');
    }
}