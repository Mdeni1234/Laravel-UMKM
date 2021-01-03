<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = "banners";
    
    public function product() {
        return $this->belongsTo(Product::class, 'id_product' );
    }
}
