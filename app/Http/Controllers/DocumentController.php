<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isJson()) {
                    $documents = Document::get(); // Adjust the number per page as needed
            return response()->json($documents);
}        $documents = Document::paginate(10); // Adjust the number per page as needed

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Save the document
        Document::create($validated);

        return redirect()->route('documents.index')->with('success', 'Document added successfully!');
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Update the document
        $document->update($validated);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }
}
