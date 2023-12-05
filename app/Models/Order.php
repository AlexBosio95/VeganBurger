<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function parts()
    {
        return $this->belongsToMany(Part::class, 'order_items')
            ->withPivot(['quantity_ordered', 'unit_price', 'subtotal']);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    protected $fillable = ['order_number', 'supplier_id', 'order_date', 'arrival_date', 'status'];
}
