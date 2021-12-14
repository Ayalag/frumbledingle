<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
 
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
