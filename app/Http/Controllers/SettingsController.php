<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:en,sq'
        ]);

        $user = Auth::user();
        $user->language = $request->language;
        $user->save();

        return redirect()->back()->with('success', __('settings.language_updated'));
    }
}
