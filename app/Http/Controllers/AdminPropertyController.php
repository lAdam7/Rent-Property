<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class AdminPropertyController extends Controller
{
    public function index()
    {
        return view('admin.applications.properties', [
            'properties' => Property::where('approved', false)->paginate(10)
        ]);
    }

    public function update(Property $property)
    {
        $property['approved'] = true;
        $property->update();

        return redirect('/admin/applications/properties')->with('success', 'Accepted property application');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return redirect('/admin/applications/properties')->with('success', 'Rejected property application');
    }

    public function edit(Property $property)
    {
        return view('admin.property.edit', [
            'property' => $property
        ]);
    }
}
