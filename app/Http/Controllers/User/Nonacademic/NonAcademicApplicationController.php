<?php

namespace App\Http\Controllers\User\Nonacademic;

use App\Http\Controllers\Controller;
use App\Models\Non_Academic_Applications;
use Illuminate\Http\Request;

class NonAcademicApplicationController extends Controller
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
    public function showForm()
    {
        return view('users.user.Nonacademic.application');
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
     * @param  \App\Models\Non_Academic_Applications  $non_Academic_Applications
     * @return \Illuminate\Http\Response
     */
    public function show(Non_Academic_Applications $non_Academic_Applications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Non_Academic_Applications  $non_Academic_Applications
     * @return \Illuminate\Http\Response
     */
    public function edit(Non_Academic_Applications $non_Academic_Applications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Non_Academic_Applications  $non_Academic_Applications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Non_Academic_Applications $non_Academic_Applications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Non_Academic_Applications  $non_Academic_Applications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Non_Academic_Applications $non_Academic_Applications)
    {
        //
    }
}
