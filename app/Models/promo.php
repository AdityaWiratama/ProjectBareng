<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['name', 'description', 'price', 'original_price', 'image', 'slug'];
}
