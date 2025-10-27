<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        
        // Validate locale
        if (!in_array($locale, ['en', 'pt', 'fr'])) {
            return redirect()->back();
        }

        // Set the locale in the session
        Session::put('locale', $locale);
        App::setLocale($locale);

        // Update user's language preference if authenticated
        if (Auth::check()) {
            Auth::user()->update(['language' => $locale]);
        }

        // Redirect back or to referer
        $referer = $request->input('referer', route('homepage.show'));
        return redirect($referer);
    }
}
