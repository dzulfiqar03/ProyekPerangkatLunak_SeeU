<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoUmkm extends Model
{
    protected $table = 'photoUmkm';

    protected $fillable = [
        'id_user',
        'city_id',
        'category_id'
    ];

    use HasFactory;
    public function detailUmkm()
    {
        return $this->belongsTo(DetailUmkm::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
