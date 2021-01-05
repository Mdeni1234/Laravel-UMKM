<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['umkm', 'title','description', 'category', 'profile_img', 'banner_img', 'banner', 'highlight']; 
    public function banner() {
        return $this->hasOne(Banner::class);
    }
    public function highlight() {
        return $this->hasOne(Highlight::class);
    }
}
