<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Part;
use App\Models\Order;

class Orderitem extends Model
{
    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = ['order_id', 'part_id', 'quantity_ordered', 'unit_price', 'subtotal', 'completed'];
}
