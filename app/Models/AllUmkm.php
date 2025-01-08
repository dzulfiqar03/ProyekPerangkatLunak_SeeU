<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllUmkm extends Model
{
    protected $table = 'allumkm';

    protected $fillable = [
        'id_user',
        'city_id',
        'category_id'
    ];

    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

    public function detailUmkm()
    {
        return $this->hasOne(DetailUmkm::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
