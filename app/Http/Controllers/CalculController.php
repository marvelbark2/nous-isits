<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculController extends Controller
{
    public function index()
    {
        return view('cl.index');
    }
    public function result(Request $request)
    {
        $cc1 = $request->get('cc1');
        $cc2 = $request->get('cc2');
        $rcc = $request->get('rcc');
        $rtp = $request->get('RTP');
        $result = (10 - ($rcc*0.15 + $rtp*0.15))/0.7;
        return view('cl.index')->with('result', $result);
    }
}
