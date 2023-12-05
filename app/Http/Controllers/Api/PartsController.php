<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Part;

class PartsController extends Controller
{
    public function getAllParts()
    {
        $parts = Part::where('visible', true)->get();

        $modifiedParts = $parts->map(function ($part) {
            $part->image = str_replace('parts_img/', '', $part->image);
            return $part;
        });

        return response()->json(['data' => $modifiedParts]);
    }
}
