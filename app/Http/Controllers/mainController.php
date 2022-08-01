<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SuperAdmin;
use App\Models\VehicleFuel;
use App\Models\VehicleMaintenance;

class mainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $sunday = date('Y-m-d', strtotime('this week Sunday'));
        $monday = date('Y-m-d', strtotime('this week Monday'));
        $tuesday = date('Y-m-d', strtotime('this week Tuesday'));
        $wednesday = date('Y-m-d', strtotime('this week Wednesday'));
        $thursday = date('Y-m-d', strtotime('this week Thursday'));
        $friday = date('Y-m-d', strtotime('this week Friday'));
        $saturday = date('Y-m-d', strtotime('this week Saturday'));

        $sundayF = VehicleFuel::where(['updated_at' => $sunday])->sum('fuelLitre');
        $mondayF = VehicleFuel::where(['updated_at' => $monday])->sum('fuelLitre');
        $tuesdayF = VehicleFuel::where(['updated_at' => $tuesday])->sum('fuelLitre');
        $wednesdayF = VehicleFuel::where(['updated_at' => $wednesday])->sum('fuelLitre');
        $thursdayF = VehicleFuel::where(['updated_at' => $thursday])->sum('fuelLitre');
        $fridayF = VehicleFuel::where(['updated_at' => $friday])->sum('fuelLitre');
        $saturdayF = VehicleFuel::where(['updated_at' => $saturday])->sum('fuelLitre');

        $sundayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $sunday])
        ->sum('maintenanceTotalPrice');
        $mondayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $monday])
        ->sum('maintenanceTotalPrice');
        $tuesdayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $tuesday])
        ->sum('maintenanceTotalPrice');
        $wednesdayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $wednesday])
        ->sum('maintenanceTotalPrice');
        $thursdayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $thursday])
        ->sum('maintenanceTotalPrice');
        $fridayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $friday])
        ->sum('maintenanceTotalPrice');
        $saturdayM = VehicleMaintenance::where(['maintenanceStatus' => 'Paid','updated_at' => $saturday])
        ->sum('maintenanceTotalPrice');

        $data = [
        'page' => 'dashboard',
        'sundayF' => $sundayF,
        'mondayF' => $mondayF,
        'tuesdayF' => $tuesdayF,
        'wednesdayF' => $wednesdayF,
        'thursdayF' => $thursdayF,
        'fridayF' => $fridayF,
        'saturdayF' => $saturdayF,
        'sundayM' => $sundayM,
        'mondayM' => $mondayM,
        'tuesdayM' => $tuesdayM,
        'wednesdayM' => $wednesdayM,
        'thursdayM' => $thursdayM,
        'fridayM' => $fridayM,
        'saturdayM' => $saturdayM
        ];
        return view('index',$data);
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
