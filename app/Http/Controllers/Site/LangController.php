<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{

    public function __invoke(Request $request)
    {
        session()->put('locale',$request->get('lang') ?? 'en');

        return redirect()->back();
    }
}
