<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;

class ClinicController extends Controller
{
    /**
     * Store a new clinic.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:clinics',
            'contact_number' => 'required|string|max:15',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filePath = $file->store('images/clinics', 'public');
            $data['logo'] = $filePath;
        }

        $clinic = Clinic::create($data);

        return response()->json([
            'message' => 'Clinic added successfully!',
            'clinic' => $clinic,
        ], 201);
    }

    /**
     * Fetch all clinics.
     */
    public function getClinics()
    {
        $clinics = Clinic::all();

        // Add the full URL for the logo image
        foreach ($clinics as $clinic) {
            if ($clinic->logo) {
                $clinic->logo = asset('storage/' . $clinic->logo);
            }
        }

        return response()->json($clinics);
    }

    /**
     * Fetch a specific clinic by ID.
     */
    public function getClinicById($id)
{
    $clinic = Clinic::find($id);

    if (!$clinic) {
        return response()->json([
            'message' => 'Clinic not found.',
        ], 404);
    }

    // Add full URL for the logo image
    if ($clinic->logo) {
        $clinic->logo = asset('storage/' . $clinic->logo);
    }

    return response()->json($clinic);
}
public function show($id)
{
    $clinic = Clinic::findOrFail($id);
    
    if ($clinic->logo) {
        $clinic->logo = asset('storage/' . $clinic->logo);
    }

    return response()->json($clinic);
}
    
}
