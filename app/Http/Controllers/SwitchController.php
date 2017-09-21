<?php

namespace Fresh\Estet\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->all());
        if ($request->isMethod('post')) {
            if ($request->has('doc')) {
                if ($request->has('remember')) {
                    Cookie::queue('user_status', 1, 24 * 60);
                }
                $request->session()->put('doc', true);
                return redirect(route('doctors'));
            } else {
                $request->session()->forget('doc');
                return redirect(route('main'));
            }
        }
        return false;
    }
}
