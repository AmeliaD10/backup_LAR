<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'pet' => 'required|string|max:50',
            'breed' => 'required|string|max:50',
            'treatment' => 'required|string|max:50',
            'petName' => 'required|string|max:50',
            'time' => 'required|string|max:5',
            'date' => 'required|date',
        ]);

        $appointment = Appointment::create($validatedData);

        return response()->json($appointment, 201);
    }

    public function index()
    {
        return Appointment::all();
    }

    public function update(Request $request, $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            
            if ($request->has('doctor_id')) {
                $appointment->doctor_id = $request->doctor_id;
                $appointment->status = 'Assigned';
            }
            
            if ($request->has('status')) {
                $appointment->status = $request->status;
            }
            
            $appointment->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully',
                'appointment' => $appointment
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update appointment: ' . $e->getMessage()
            ], 500);
        }
    }
}