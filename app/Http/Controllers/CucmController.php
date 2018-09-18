<?php

namespace App\Http\Controllers;

use App\Cucm;
use Illuminate\Http\Request;

class CucmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cucms = Cucm::all();
        return view('cucms.index', compact('cucms'));
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
     * @param  \App\Cucm  $cucm
     * @return \Illuminate\Http\Response
     */
    public function show(Cucm $cucm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cucm  $cucm
     * @return \Illuminate\Http\Response
     */
    public function edit(Cucm $cucm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cucm  $cucm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cucm $cucm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cucm  $cucm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cucm $cucm)
    {
        //
    }
}
