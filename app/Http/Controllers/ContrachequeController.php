<?php

namespace App\Http\Controllers;

use App\Models\Contracheque;
use App\Http\Requests\StoreContrachequeRequest;
use App\Http\Requests\UpdateContrachequeRequest;
use Illuminate\Http\Request;

class ContrachequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formulario()
    {
        return view('app.formulario');
    }

    public function fichaauxiliar(Request $request)
    {
        dd($request->request);
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
     * @param  \App\Http\Requests\StoreContrachequeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContrachequeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contracheque  $contracheque
     * @return \Illuminate\Http\Response
     */
    public function show(Contracheque $contracheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contracheque  $contracheque
     * @return \Illuminate\Http\Response
     */
    public function edit(Contracheque $contracheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContrachequeRequest  $request
     * @param  \App\Models\Contracheque  $contracheque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContrachequeRequest $request, Contracheque $contracheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contracheque  $contracheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contracheque $contracheque)
    {
        //
    }
}
