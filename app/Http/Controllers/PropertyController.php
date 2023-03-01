<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        return view('properties');
    }

    public function show(Property $property)
    {
        return view('property',[
            'property' => $property
        ]);
    }
}
