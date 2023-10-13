<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'number', 'category_id', 'hobby_id', 'image'];

    // relationship with category

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
