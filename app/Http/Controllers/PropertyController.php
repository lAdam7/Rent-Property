<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyImages;

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
            'types' => PropertyType::all()
        ]);
    }

    public function store()
    {
        $attributes = $this->validateProperty();

        $attributes['user_id'] = auth()->id();

        $property = Property::create($attributes);
        
        $imageAttributes = request()->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        foreach ($imageAttributes['images'] as $k => $image)
        {
            $imageName = auth()->id() . '-' . $k  . '-' . time() . '.' . $image->extension();
            $image->move(public_path('images/thumbnails'), $imageName);
            $image = $imageName;

            PropertyImages::create([
                'property_id' => $property->id,
                'thumbnail' => $imageName
            ]);
        }

        return redirect("dashboard/properties")->with("success", "This listing is awaiting approval by a site administrator!");
    }

    public function edit(Property $property)
    {
        return view('landlord.edit', [
            'property' => $property,
            'types' => PropertyType::all()
        ]);
    }

    public function update(Property $property)
    {
        $attributes = $this->validateProperty($property);
        $attributes['approved'] = false;
        $property->update($attributes);

        return redirect("dashboard/properties")->with('success', 'Property updated, awaiting re-approval from an admin!');
    }

    protected function validateProperty(?Property $property = null): array
    {
        $user ??= new Property(); // if null just use blank template

        return request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'street' => ['required', 'min:4', 'max:255'],
            'town_or_city' => ['required', 'min:3', 'max:255'],
            'available' => ['required', 'date'],
            'deposit' => ['required', 'integer', 'between:0,2500'],
            'price' => ['required', 'integer', 'between:300,2500'],
            'min_tenancy' => ['required', 'max:20'],
            'property_type_id' => ['exists:property_type,id'],
            'furnished' => [''],
            'garden' => [''],
            'parking' => [''],
            'bedrooms' => ['required', 'integer', 'between:1,25'],
            'bathrooms' => ['required', 'integer', 'between:1,25'],
            'body' => ['required', 'min:50', 'max:1000']
        ]);
    }
}
