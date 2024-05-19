<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'name', 
        'merk', 
        'category_id', 
        'qty', 
        'price'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
