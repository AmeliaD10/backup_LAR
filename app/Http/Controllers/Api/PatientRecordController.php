<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^09[0-9]{9}$/', // Match PH phone numbers
            'pet' => 'required|string|in:dog,cat',
            'breed' => 'required|string|max:255',
            'treatment' => 'required|string|in:rabies,vaccination,checkup,immunization',
            'pet_name' => 'required|string|max:255',
            'time' => 'required|string|in:9am,11am,1pm,3pm,5pm',
            'date' => 'required|date|after_or_equal:today'
        ]);
        

        $record = PatientRecord::create($validated);

        return response()->json([
            'message' => 'Patient record created successfully.',
            'data' => $record,
        ], 201);
    }
    public function index()
    {
        // Fetch all patient records
        $patients = PatientRecord::all();
        return response()->json($patients);
    }
    
}
