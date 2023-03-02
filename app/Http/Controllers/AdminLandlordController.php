<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landlord;

class AdminLandlordController extends Controller
{
    public function index()
    {
        return view('admin.applications.landlords', [
            'applications' => Landlord::where('approved', false)->paginate(25)
        ]);
    }

    public function update(Landlord $application)
    {
        $application->update([
            'approved' => true
        ]);

        $name = $application->user->forename . ' ' . $application->user->surname;
        return redirect('/admin/applications/landlords')->with('success', 'Accepted ' . $name . ' as a landlord, they can now apply to list properties');
    }

    public function destroy(Landlord $application)
    {
        $application->delete();

        return redirect('/admin/applications/landlords')->with('success', 'Rejected landlord application');
    }

    public function edit(Landlord $landlord)
    {
        return view('admin.landlord.edit', [
            'landlord' => $landlord
        ]);
    }
}
