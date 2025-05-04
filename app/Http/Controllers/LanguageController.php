<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function SwitchLanguage($language, Request $request)
    {
        $request->session()->put('language', $language); // Store the selected language in session
        return redirect()->back();
    }
}


