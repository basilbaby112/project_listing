<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    // relationship with listng data

    public function listItems()
    {
        return $this->hasMany(Listing::class);
    }
}
