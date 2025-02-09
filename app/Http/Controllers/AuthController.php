<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Handle the login logic
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'profile_picture' => $user->profile_picture ?? '/img/default-profile.jpg'
                ]
            ]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    // Handle the logout logic
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function getUserProfile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has a profile picture, if not, handle the situation accordingly
        $profilePicture = $user->profile_picture ? $user->profile_picture : '/img/default-profile.jpg'; // Default if not set

        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'profile_picture' => $profilePicture,
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            \Log::info('Update Profile Request:', $request->all()); // Add logging
            
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'profile_picture' => 'nullable|image|max:2048'
            ]);

            if ($request->hasFile('profile_picture')) {
                \Log::info('Processing profile picture'); // Add logging
                
                // Delete old profile picture if it exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $validated['profile_picture'] = $path;
            }

            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'profile_picture' => $user->profile_picture
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Profile Update Error: ' . $e->getMessage()); // Add logging
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
