<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;
    protected $table = "highlight";
    public function product() {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
