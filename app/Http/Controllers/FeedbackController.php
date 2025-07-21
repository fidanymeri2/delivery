<?php
namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
public function index(Request $request)
{
    $feedbacks = Feedback::orderBy("id","DESC");
     
if ($request->isJson()) {
    $feedbacks = $feedbacks->where('publish',1)->get();
            return response()->json($feedbacks);
    }
$feedbacks = $feedbacks->get();
    return view('feedbacks.index', compact('feedbacks'));
}

public function create()
{
    return view('feedbacks.create');
}

public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

    Feedback::create($request->all());
    
      if ($request->isJson()) {
            return response()->json(["success" => true]);
        }
    return redirect()->route('feedbacks.index')->with('success', 'Feedback created successfully.');
}

public function show(Feedback $feedback)
{
    return view('feedbacks.show', compact('feedback'));
}

public function edit(Feedback $feedback)
{
    return view('feedbacks.edit', compact('feedback'));
}

public function update(Request $request, Feedback $feedback)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
        'publish' => 'required|boolean',
    ]);

    $feedback->update($request->all());
    return redirect()->route('feedbacks.index')->with('success', 'Feedback updated successfully.');
}

public function destroy(Feedback $feedback)
{
    $feedback->delete();
    return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
}

}
