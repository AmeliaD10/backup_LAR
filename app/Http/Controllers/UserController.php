<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            // 'profile_picture' => 'image|max:2048',
        ]);

        // $profilePicturePath = null;
        // if ($request->hasFile('profile_picture')) {
        //     $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        // }

        // Create the user
        User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            // 'profile_picture' => $profilePicturePath,
            'role' => 0,
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    public function getUsers()
    {
        $users = User::where('role', 1) // Filter only users with role = 1
                    ->select('first_name', 'middle_name', 'last_name', 'email')
                    ->get();

        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully.']);
        } else {
            return response()->json(['message' => 'User not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'role' => 'sometimes|required|in:0,1', // Validate role to be either 0 or 1
        ]);

        if ($request->has('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully']);
    }
}
