<?php

namespace App\Http\Controllers;

use App\Prepa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrepaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratt = \App\Notes::where('rattr', '1')->get();
        $p = Prepa::all();
        return view('prepa.index', compact('ratt', 'p'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Prepa;
        $p->matiere_id = $request->get('ename');
        $p->description = $request->get('edesc');
        $p->className = $request->get('ecolor');
        $p->icon = $request->get('eicon');
        $p->start_at = Carbon::parse($request->input("esdate"));
        $p->end_at = Carbon::parse($request->input("eedate"));
        $p->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prepa  $prepa
     * @return \Illuminate\Http\Response
     */
    public function show(Prepa $prepa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prepa  $prepa
     * @return \Illuminate\Http\Response
     */
    public function edit(Prepa $prepa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prepa  $prepa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prepa $prepa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prepa  $prepa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prepa $prepa)
    {
        //
    }
}
