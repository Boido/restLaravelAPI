<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\apiModel;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_name','category_image'
    ];

    function apiModel(){
        return $this->hasMany(apiModel::class, 'category_id', 'id');
    }
}
