<?php

namespace App\Http\Controllers;

use App\LAN;
use Illuminate\Http\Request;

class LANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lans = LAN::all();
        return view('lans.liste_lan', compact('lans'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LAN  $lAN
     * @return \Illuminate\Http\Response
     */
    public function show(LAN $lan)
    {
        return view('lans.fiche_lan', compact('lan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LAN  $lAN
     * @return \Illuminate\Http\Response
     */
    public function edit(LAN $lan)
    {
        return view('lans/fiche_lan', compact('lan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LAN  $lAN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LAN $lAN)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LAN  $lAN
     * @return \Illuminate\Http\Response
     */
    public function destroy(LAN $lAN)
    {
        //
    }
}
