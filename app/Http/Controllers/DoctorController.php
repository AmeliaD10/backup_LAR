<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|email|unique:doctors,email',
            'address' => 'required|string|max:255',
        ]);

        $doctor = Doctor::create($validated);

        return response()->json($doctor, 201);
    }
    public function destroy($id)
{
    $doctor = Doctor::find($id);

    if (!$doctor) {
        return response()->json(['message' => 'Doctor not found'], 404);
    }

    $doctor->delete();

    return response()->json(['message' => 'Doctor deleted successfully'], 200);
}

}
