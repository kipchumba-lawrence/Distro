<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $fillable = ['customer_id', 'order_date', 'total', 'status'];
    use HasFactory;

    public function orderItems(){
        return $this->hasMany(OrderDetail::class);
    }
}
