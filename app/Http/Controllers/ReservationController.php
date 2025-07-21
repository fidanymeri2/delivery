<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $reservations = Reservation::orderBy("id","DESC")->paginate(10); 
        return view('reservations.index', compact('reservations'));
    }
    

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|max:10',
            'date' => 'nullable|date',
            'time_reservation' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        Reservation::create($validated);
        if ($request->isJson()) {
            return response()->json(["success" => true]);
        }
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',  // Ensure this matches your form input name
        'postal_code' => 'required|string|max:10',
        'date' => 'required|date',
        'time_reservation' => 'required|date_format:H:i',
        'description' => 'nullable|string',
    ]);

    // Use the correct variable $validatedData to update the reservation
    $reservation->update($validatedData);

    return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
}


    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
