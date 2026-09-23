<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // ==================================================
    // SHOW PROFILE
    // ==================================================
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }

    // ==================================================
    // EDIT FORM
    // ==================================================
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    // ==================================================
    // UPDATE INFO (name + email)
    // ==================================================
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->update($data);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    // ==================================================
    // UPDATE PASSWORD
    // ==================================================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Password changed successfully.');
    }
}