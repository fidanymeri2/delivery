<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index(Request $request)
    {
          if ($request->isJson()) {
                    $messages = Message::get(); // Adjust the number per page as needed
            return response()->json($messages);
}
        $messages = Message::paginate(10);
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Message::create($validatedData);

        return redirect()->route('messages.index')->with('success', 'Message created successfully.');
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, Message $message)
{ 
      $validatedData = ['description'=>$request->description];
if($request->from)
{
$time = $request->from .'-'.$request->to;
$validatedData = ['description'=>$time];
}

if($request->category == 'LOGO')
{
$image =  $request->file('description');
$imagePath = $image->store('images', 'public');
$validatedData = ['description'=>$imagePath];
} 


        $message->update($validatedData);

        return redirect()->route('messages.index')->with('success', 'Message updated successfully.');
    }

    public function sort(Request $request)
{
    $order = $request->input('order');

    foreach ($order as $position => $id) {
        Message::where('id', $id)->update(['position' => $position]);
    }

    return response()->json(['success' => true]);
}

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }
}
