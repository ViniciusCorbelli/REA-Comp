<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller {

    public function languageSwitch(Request $request) {
        $language = $request->input('language');

        session(['language' => $language]);
        app()->setLocale($language);

        return response()->json( app()->getLocale());
    }
}
