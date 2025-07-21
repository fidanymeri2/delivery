<?php

namespace App\Http\Controllers;

use App\Models\Waiter;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    /**
     * Display a listing of the waiters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiters = Waiter::paginate(10); // Fetch waiters
        return view('users.index', compact('waiters'));
    }

    /**
     * Show the form for creating a new waiter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('waiters.create');
    }

    /**
     * Store a newly created waiter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pin_code' => 'required|string|size:4|unique:waiters', // Example validation
        ]);
    
        Waiter::create($request->all());
    
        return redirect()->route('users.index')->with('success', 'Waiter created successfully.');
    }

    /**
     * Display the specified waiter.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function show(Waiter $waiter)
    {
        return view('waiters.show', compact('waiter'));
    }

    /**
     * Show the form for editing the specified waiter.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function edit(Waiter $waiter)
    {
        return view('waiters.edit', compact('waiter'));
    }

    /**
     * Update the specified waiter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waiter $waiter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pin_code' => 'required|string|max:10|unique:waiters,pin_code,' . $waiter->id,
        ]);

        $waiter->update($request->all());

        return redirect()->route('users.index')
                         ->with('success', 'Waiter updated successfully.');
    }

    /**
     * Remove the specified waiter from storage.
     *
     * @param  \App\Models\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waiter $waiter)
    {
        $waiter->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Waiter deleted successfully.');
    }
}
