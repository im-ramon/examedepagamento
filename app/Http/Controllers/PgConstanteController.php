<?php

namespace App\Http\Controllers;

use App\Models\PgConstante;
use App\Http\Requests\StorePgConstanteRequest;
use App\Http\Requests\UpdatePgConstanteRequest;

class PgConstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(PgConstante::all());
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
     * @param  \App\Http\Requests\StorePgConstanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePgConstanteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PgConstante  $pgConstante
     * @return \Illuminate\Http\Response
     */
    public function show(PgConstante $pgConstante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PgConstante  $pgConstante
     * @return \Illuminate\Http\Response
     */
    public function edit(PgConstante $pgConstante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePgConstanteRequest  $request
     * @param  \App\Models\PgConstante  $pgConstante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePgConstanteRequest $request, PgConstante $pgConstante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PgConstante  $pgConstante
     * @return \Illuminate\Http\Response
     */
    public function destroy(PgConstante $pgConstante)
    {
        //
    }
}
