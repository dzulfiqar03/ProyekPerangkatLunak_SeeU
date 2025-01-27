<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }

    public function umkmapprove()
    {
        return $this->hasMany(ApproveUMKMModel::class);
    }

    public function allUmkm()
    {
        return $this->hasMany(AllUmkm::class, 'category_id');
    }
}
