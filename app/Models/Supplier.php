<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
    
    protected $fillable = ['suppliers_id', 'name', 'contact_person', 'email', 'phone', 'address'];
}
