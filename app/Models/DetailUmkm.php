<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUmkm extends Model
{
    use HasFactory;

    protected $table = 'detailUmkm';

    

// Relasi dengan model AllUmkm
public function allUmkm()
{
    return $this->belongsTo(AllUmkm::class, 'umkm_id');
}

public function photoUmkm()
{
    return $this->hasMany(PhotoUmkm::class, 'umkm_id');
}

}
