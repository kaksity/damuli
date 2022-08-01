<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\VehicleFuel;
use App\Models\FuelDepartment;
use App\Models\Vehicle;

class FuelDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $Vehicle = Vehicle::all();
        $VehicleFuel = VehicleFuel::all();
        return view('index',['page' => 'fuel data','vehicle' => $Vehicle,'fuelData' => $VehicleFuel]);
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
        //return $req -> fuelTotal;
        $fleetId = Vehicle::where(['vehiclePlateNumber' => $req -> vehicleId])->value('fleetId');
        $fillingStationId = FuelDepartment::where(['email' => session('email')])->value('fillingStationId');
        $data = new VehicleFuel;
        $data -> vehicleId = $req -> vehicleId;
        $data -> fuelLitre = $req -> fuelLitre;
        $data -> fuelPrice = $req -> fuelPrice;
        $data -> fuelTotalPrice = $req -> fuelTotal;
        $data -> fleetId = $fleetId;
        $data -> fillingStationId = $fillingStationId;
        $data -> save();

        return redirect('fuel data');
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
    public function edit(Request $req)
    {

        $count = (count($req->all())-1)/3;
        for($i = 1; $i <= $count; $i++){
            $type = 'type'.$i;
            echo $req -> $type;
            echo '<br>';
        }
        return 'good';
        //$count = {"good":"2","bad":"1"};
        // $count = count($count);
        // echo $count;
        //return 'Arr';
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
        $fleetId = Vehicle::where(['vehiclePlateNumber' => $req -> vehicleId])->value('fleetId');
        $data = VehicleFuel::where(['id' => $req -> id])->update([
        'vehicleId' => $req -> vehicleId,
        'fuelLitre' => $req -> fuelLitre,
        'fuelPrice' => $req -> fuelPrice,
        'fuelTotalPrice' => $req -> fuelTotal,
        'fleetId' => $fleetId
        ]);
        $req -> session() -> flash('message', 'Fuel Data Updated');
        return redirect('fuel data');
    }

    /*
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
