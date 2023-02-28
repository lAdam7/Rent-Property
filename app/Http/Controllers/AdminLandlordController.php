<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class AdminLandlordController extends Controller
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

        return back()->with('success', 'Accepted property application');
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return back()->with('success', 'Rejected property application');
    }
}
