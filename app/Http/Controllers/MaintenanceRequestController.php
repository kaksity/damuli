<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceDepartment;
use App\Models\VehicleMaintenance;
use App\Models\Vehicle;

class MaintenanceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $VehicleMaintenance = VehicleMaintenance::all();
        $Vehicle = Vehicle::all();
        return view('index',['page' => 'maintenance request','vehicleMaintenance' => $VehicleMaintenance,'vehicle' => $Vehicle]);
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
        $data = new VehicleMaintenance;
        $data -> vehicleId = $req -> vehicleId;
        $data -> maintenanceStation = $req -> maintenanceStation;
        $data -> maintenanceType = $req -> maintenanceType;
        $data -> maintenanceTotalPrice = $req -> maintenanceTotalPrice;
        $data -> accountNumber = $req -> accountNumber;
        $data -> accountName = $req -> accountName;
        $data -> bankName = $req -> bankName;
        $data -> maintenanceComment = $req -> comment;
        $data -> maintenanceStatus = 'Pending';
        $data -> user = session('email');
        $data -> verify = 'None';
        $data -> approve = 'None';
        $data -> pay = 'None';
        $data -> save();

        $data = Vehicle::where(['vehiclePlateNumber' => $req -> vehicleId])->update([
        'vehicleStatus' => 'Maintenance'
        ]);

        $req -> session() -> flash('message', 'Request Sent');
        return redirect('maintenance request');
    }

    public function accept(Request $req)
    {
        if($req->maintenanceStatus == 'Verified')$column = 'verify';
        if($req->maintenanceStatus == 'Approved')$column = 'approve';
        if($req->maintenanceStatus == 'Paid')$column = 'pay';

        $staff = VehicleMaintenance::where(['id' => $req -> id])->update([
        'maintenanceStatus' => $req -> maintenanceStatus,
        $column => session('email')
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> maintenanceStatus));
        return redirect('maintenance request');
    }

   
    public function reject(Request $req)
    {
        $staff = VehicleMaintenance::where(['id' => $req -> id])->update([
        'maintenanceStatus' => $req -> maintenanceStatus
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> maintenanceStatus));
        return redirect('maintenance request');
    }

 
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
    public function destroy(Request $req)
    {
        if(!session()->has('log')){return redirect('/');}
        $staff = VehicleMaintenance::find($req->id)->delete();
        
        $req -> session() -> flash('message', 'Request Removed');
        return redirect('maintenance request');
    }
}
