<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners  = Banner::all();
         if ($request->isJson()) {
            return response()->json($banners);
        }
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024', // max:1024 means max 1MB
            'status' => 'boolean',
            'title' =>'required|string|max:255',
            'description'  =>'required|string|max:255',
        ]);
    
        // Check resolution on the server side
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            list($width, $height) = getimagesize($image);
    
            if ($width != 689 || $height != 255) {
                return redirect()->back()->withErrors(['image' => 'The image resolution must be 1920x1080.']);
            }
    
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('banners', $imageName, 'public');
    
            Banner::create([
                'image_url' => $imageName,
                'status' => $request->has('status') ? true : false,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
    
        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }
    

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean', // Accepts true or false
            'title' =>'nullable|string|max:255',
            'description'  =>'nullable|string|max:255',
        ]);
    
        if ($request->hasFile('image')) {
            if ($banner->image_url) {
                Storage::disk('public')->delete('banners/' . $banner->image_url);
            }
    
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('banners', $imageName, 'public');
            $banner->image_url = $imageName;

        }
        $banner->title = $request->title;
        $banner->description  = $request->description;
            
        // Set status as integer
        $banner->status = $request->has('status') ? 1 : 0;
        $banner->save();
    
        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }
    
    

    public function destroy(Banner $banner)
    {
        if ($banner->image_url) {
            Storage::disk('public')->delete('banners/' . $banner->image_url);
        }

        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
