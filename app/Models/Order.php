<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'phone', 'address', 'quantity', 'status', 'product_slug', 'total_price', 'flavor'];
}
