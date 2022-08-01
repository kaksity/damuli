<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FillingStation;

class FillingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $FillingStation = FillingStation::all();
        return view('index',['page' => 'filling station','fillingStation' => $FillingStation]);
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
    public function store(Request $req)
    {
        if(!session()->has('log')){return redirect('/');}
        $staff = new FillingStation;
        $staff -> fillingStationName = $req -> name;
        $staff -> fillingStationLocation = $req -> location;
        $staff -> fillingStationLitres = 0;
        $staff -> fillingStationBalance = 0;
        $staff -> fillingStationTotalLitre = 0;
        $staff -> fillingStationTotalBalance = 0;
        $staff -> save();
        $req -> session() -> flash('message', 'Filling Station Added');
        return redirect('filling station');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req)
    {
        if(!session()->has('log')){return redirect('/');}
        $staff = FillingStation::where(['id' => $req -> user_id])->update([
        'fillingStationName' => $req -> name,
        'fillingStationLocation' => $req -> location
        ]);       

        $req -> session() -> flash('message', 'Filling Station Updated');
        return redirect('filling station');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
