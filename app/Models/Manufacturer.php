<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    protected $fillable = ['name', 'country', 'contact_email', 'phone_number', 'website', 'contact_person', 'address'];
}
