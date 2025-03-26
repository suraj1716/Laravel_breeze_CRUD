<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller ;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('admin.profile.edit', [
            'user' => Auth::guard('admin')->user()
        ]);

        dd('user');

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

    // Check if admin is fetched
    dd($admin);

    // Fill the admin model with validated data
    $admin->fill($request->validated());

    // Check if there are any changes
    dd($admin->getDirty());

    if ($admin->isDirty('email')) {
        $admin->email_verified_at = null;
    }

    // Save the changes
    $admin->save();

    // Redirect back with success message
    return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
 }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
