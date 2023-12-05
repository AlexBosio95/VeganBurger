<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Manufacturer;

class Part extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot(['quantity_ordered', 'unit_price', 'subtotal']);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    protected $fillable = ['category_id', 'part_number', 'name', 'description', 'quantity', 'price', 'manufacturer_id', 'location', 'image', 'visible'];
}
