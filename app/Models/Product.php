<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supllier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
