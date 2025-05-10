<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function SwitchLanguage($language, Request $request)
    {
        $request->session()->put('language', $language);
        return redirect()->back();
    }
}


