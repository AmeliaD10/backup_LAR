<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        try {
            $doctors = Doctor::all();
            return response()->json($doctors);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch doctors'], 500);
        }
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

public function getAppointments($id)
{
    try {
        $doctor = Doctor::findOrFail($id);
        $appointments = Appointment::where('doctor_id', $id)
            ->where('status', 'Assigned')
            ->select('id', 'name', 'date', 'time', 'treatment', 'status')
            ->get();

        return response()->json($appointments);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch appointments'], 500);
    }
}

}