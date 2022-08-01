<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FleetOfficer;
use App\Models\Vehicle;
use App\Models\VehicleFuel;
use App\Models\VehicleMaintenance;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        if(session('accType') == 'Super Admin'){
            $supervisor = FleetOfficer::all();
            $lists = DB::table('vehicles') ->orderBy('vehicles.vehicleName','ASC')->get();
        }
        if(session('accType') == 'Fleet Officer'){
            $supervisor = Supervisor::all();
            $lists = DB::table('vehicles')->join('fleet_officer','vehicles.fleetId',"=",'fleet_officer.id')
            ->where('fleet_officer.userId',session('user_id'))
            ->orderBy('vehicles.vehicleName','ASC')->get();
        }
        $pageData = [
            'page' => 'vehicle',
            'fleetOfficers' => $supervisor,
            'vehicles' => $lists
        ];

        return view('index', $pageData);
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
        if (Vehicle::where(['vehiclePlateNumber' => $req -> vehiclePlateNumber])->exists()) {
            $req -> session() -> flash('message', 'Vehicle Already Exits');
            return redirect('vehicle');
        }else{
        if($req -> vehicleOwnerName == ''){$owner = 'Not Set';}else{$owner = $req -> vehicleOwnerName;}
        if($req -> vehicleOwnerPhone == ''){$phone = 'Not Set';}else{$phone = $req -> vehicleOwnerPhone;}
        $staff = new Vehicle;
        $staff -> vehicleName = $req -> vehicleName;
        $staff -> vehicleType = $req -> vehicleType;
        $staff -> vehiclePlateNumber = $req -> vehiclePlateNumber;
        $staff -> vehicleOwnerName = $owner;
        $staff -> vehicleOwnerPhone = $phone;
        $staff -> vehicleColor = $req -> vehicleColor;
        $staff -> vehicleStatus = 'On Hold';
        $staff -> fleetId = 'Not Set';
        $staff -> organizationId = 'Not Set';
        $staff -> save();        

        $req -> session() -> flash('message', 'Vehicle Successfully Added');
        return redirect('vehicle');
    }
}

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
    public function update(Request $request, $id)
    {
        //
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
