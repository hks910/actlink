<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);
        $member = Member::where('memberId', $user->userId)->first();
        $organizer = Organizer::where('organizerId', $user->userId)->first();

        return view('registered.profile', compact('user', 'member', 'organizer'));
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);

        return view('registered.edit-profile', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Validate the inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
            'userImage' => 'nullable|image|max:2048', // Limit to 2MB
        ]);

        // Update user details
        $user->update($validated);

        // If image is uploaded, handle it
        if ($request->hasFile('userImage')) {
            $image = $request->file('userImage');
            $user->userImage = base64_encode(file_get_contents($image->getRealPath()));
        }

        $user->save();

        return redirect()->route('profile.edit', ['userId' => $user->userId])
                        ->with('success', 'Profile updated successfully.');
    }
}
