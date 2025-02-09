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
        // Fetch all appointments from the database
        $appointments = Appointment::all();
        
        // Return the appointments as JSON response
        return response()->json($appointments);
    }
}
