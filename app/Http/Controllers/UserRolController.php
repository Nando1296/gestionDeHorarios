<?php

namespace App\Http\Controllers;

use App\Models\UserRol;
use Illuminate\Http\Request;

class UserRolController extends Controller
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
    public function reporte()
    {
        $user_rols = UserRol::all();
        return view('Usuario-Docente.reporte_user_rol', compact('user_rols'));

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
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function show(UserRol $userRol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRol $userRol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRol $userRol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRol  $userRol
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRol $userRol)
    {
        //
    }
}
