<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveUMKMModel extends Model
{

    protected $table = 'approve_umkm';

    protected $fillable = [
        'id_user',

    ];

    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

}
