<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyFrequency;
use App\Models\PropertyType;

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

    public function create()
    {
        return view('property.create', [
            'frequencies' => PropertyFrequency::all(),
            'types' => PropertyType::all()
        ]);
    }

    public function store()
    {
        $attributes = $this->validateProperty();

        $attributes['user_id'] = auth()->id();

        $property = Property::create($attributes);

        return redirect("dashboard/properties")->with("success", "This listing is awaiting approval by a site administrator!");
    }

    protected function validateProperty(?Property $property = null): array
    {
        $user ??= new Property(); // if null just use blank template

        return request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'street' => ['required', 'min:4', 'max:255'],
            'town_or_city' => ['required', 'min:3', 'max:255'],
            'available' => ['required', 'date'],
            'deposit' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'property_frequency_id' => ['exists:property_frequency,id'],
            'min_tenancy' => ['max:20'],
            'property_type_id' => ['exists:property_type,id'],
            'furnished' => [''],
            'garden' => [''],
            'parking' => [''],
            'bedrooms' => ['integer'],
            'bathrooms' => ['integer'],
            'body' => ['required', 'min:20', 'max:1000']
        ]);
    }
}
