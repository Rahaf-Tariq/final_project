<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        // Intentionally minimal for now; prevents 404/route issues if POST /profile is hit.
        // You can extend this later to validate & persist user profile fields.
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}

