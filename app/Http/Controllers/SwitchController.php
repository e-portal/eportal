<?php

namespace Fresh\Estet\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->has('doc')) {
                if ($request->has('remember')) {
                    Cookie::queue('userstatus', true, 24 * 60, null, null, false, false);
                }
                $request->session()->put('doc', true);
                return redirect(route('doctors'), 301);
            } else {
                $request->session()->forget('doc');
                return redirect(route('main'), 301);
            }
        }
        return redirect(route('main'), 301);
    }
}
