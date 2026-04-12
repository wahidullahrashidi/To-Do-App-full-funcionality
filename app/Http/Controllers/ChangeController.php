<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangeController extends Controller
{
    public function change(Request $request)
    {
        $lang = $request->lang;
        
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
