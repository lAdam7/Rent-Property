<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landlord;

class LandlordController extends Controller
{
    public function index()
    {
        return view('landlord.index',[
            'properties' => auth()->user()->properties
        ]);
    }

    public function create()
    {
        return (!is_null(auth()->user()->landlord)) ? view('apply-landlord.success') : view('apply-landlord.create');
    }

    public function store()
    {   
        $attributes = request()->validate([
            'contact_email' => ['required', 'email', 'unique:landlords,contact_email'],
            'contact_number' => ['required', 'unique:landlords,contact_number'],
            'notes' => ['required']
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Landlord::create($attributes);

        return redirect("apply/success");
    }
}
