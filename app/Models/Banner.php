<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = "banners";
    protected $fillable = ['product_id','banner_img'];
    
    public function product() {
        return $this->belongsTo(Product::class, 'product_id' );
    }
}
