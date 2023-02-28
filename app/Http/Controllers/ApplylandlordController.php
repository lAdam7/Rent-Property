<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applylandlord;

class ApplyLandlordController extends Controller
{
    public function create()
    {
        return (is_null(auth()->user()->applylandlord)) ? view('apply-landlord.create') : view('apply-landlord.success');
    }

    public function store()
    {   
        $attributes = request()->validate([
            'notes' => ['required']
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Applylandlord::create($attributes);

        return redirect("apply/success");
    }

    public function index()
    {
        return view('admin.applications.landlords', [
            'applications' => Applylandlord::paginate(25)
        ]);
    }

    public function update(Applylandlord $application)
    {
        $application->user->update([
            'landlord' => true
        ]);

        $name = $application->user->forename . ' ' . $application->user->surname;
        $application->delete();

        return back()->with('success', 'Accepted ' . $name . ' as a landlord, they can now apply to list properties');
    }

    public function destroy(Applylandlord $application)
    {
        $application->delete();

        return back()->with('success', 'Rejected landlord application');
    }
}
