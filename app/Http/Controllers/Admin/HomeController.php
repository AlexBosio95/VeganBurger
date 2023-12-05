<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        $parts = Part::all();
        $orders = Order::all();
        return view(('admin.home'), compact('parts', 'categories', 'manufacturers', 'orders'));
    }
}
