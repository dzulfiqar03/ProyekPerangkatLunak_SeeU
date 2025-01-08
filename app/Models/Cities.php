<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{

    protected $table = 'cities';

    protected $fillable = [
        'province_id',
    ];

    use HasFactory;
    public function provinces()
    {
        return $this->belongsTo(Provinces::class);
    }

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }

    public function allUmkm()
    {
        return $this->hasMany(AllUmkm::class);
    }

    public function approveUmkm()
    {
        return $this->hasMany(ApproveUMKMModel::class);
    }

}
