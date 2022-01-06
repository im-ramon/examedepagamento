<?php

namespace App\Http\Controllers;

use App\Models\PgConstate;
use App\Http\Requests\StorePgConstateRequest;
use App\Http\Requests\UpdatePgConstateRequest;

class PgConstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePgConstateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePgConstateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PgConstate  $pgConstate
     * @return \Illuminate\Http\Response
     */
    public function show(PgConstate $pgConstate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PgConstate  $pgConstate
     * @return \Illuminate\Http\Response
     */
    public function edit(PgConstate $pgConstate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePgConstateRequest  $request
     * @param  \App\Models\PgConstate  $pgConstate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePgConstateRequest $request, PgConstate $pgConstate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PgConstate  $pgConstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(PgConstate $pgConstate)
    {
        //
    }
}
