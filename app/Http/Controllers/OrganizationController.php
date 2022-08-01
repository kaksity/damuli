<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\FleetOfficer;
use App\Models\Organization;
use App\Models\VehicleActivity;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $FleetOfficer = FleetOfficer::all();
        $vehicle = DB::table('vehicles')
            ->orderBy('vehicles.vehicleName','ASC')
            ->get();

        $lists = DB::table('organization')
        ->orderBy('organization.created_at','DESC')->get();

        $pageData = [
            'page' => 'organization',
            'clients' => $lists,
            'vehicle' => $vehicle,
            'supervisors' => $FleetOfficer
        ];
        return view('index',$pageData);
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
        $staff = new Organization;
        $staff -> organizationName = $req -> organizationName;
        $staff -> activityType = $req -> activityType;
        $staff -> vehicleType = $req -> vehicleType;
        $staff -> activityLocation = $req -> activityLocation;
        $staff -> organizationPrice = $req -> organizationPrice;
        $staff -> organizationTotalPrice = $req -> organizationTotalPrice;
        $staff -> organizationPriceUnit = 'Daily';
        $staff -> organizationContractStart = $req -> organizationContractStart;
        $staff -> organizationContractEnd = $req -> organizationContractEnd;
        $staff -> organizationContractDays = $req -> organizationContractDays;
        $staff -> organizationStatus = 'Active';
        $staff -> save();        

        $req -> session() -> flash('message', 'Organization Registered!!!');
        return redirect('Organization');
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
        //return $req -> organizationId;
        if(session('accType') == 'Fleet Officer'){

            $list = Vehicle::all(); $add = array(); $index = 0;
            foreach($list as $row){
                if($req->has($row->id)){
                   $add[$index] = $row->vehiclePlateNumber;

                   Vehicle::where(['id' => $row->id])->update([
                    'fleetId' => $req -> fleetId,
                    'vehicleStatus' => 'Active',
                    'organizationId' => $req -> organizationId
                    ]);

                    $request = new VehicleActivity;
                    $request -> vehicleId = $row->id;
                    $request -> fleetId = $req -> fleetId;
                    $request -> organizationId = $req -> organizationId;
                    $request -> activityType = $req -> activityType;
                    $request -> activityLocation = $req -> activityLocation;
                    $request -> save();

                   $index++;
                }
            }
            $list = DB::table('vehicles') -> where('organizationId',$req -> organizationId) ->get();
            foreach ($list as $row) {
                $flag = 'no';$x = 0;
                foreach ($add as $rows) {
                    if($row->vehiclePlateNumber == $add[$x]){
                        $flag = 'yes';
                    }
                    //return $rows[$x];
                    $x++;
                }
                if($flag == 'no'){
                    Vehicle::where(['id' => $row->id])->update([
                        'fleetId' => 'none',
                        'vehicleStatus' => 'Onhold',
                        'organizationId' => 0
                    ]);
                }
            }

             $adds = json_encode($add);

            $staff = Organization::where(['id' => $req -> organizationId])->update([
            'vehicleId' => $adds,
            'fleetId' => $req -> fleetId,
            'activityType' => $req -> activityType,
            'activityLocation' => $req -> activityLocation
            ]);
        }else{
            $staff = Organization::where(['id' => $req -> id])->update([
            'fleetId' => $req -> fleetId,
            'organizationName' => $req -> organizationName,
            'activityType' => $req -> activityType,
            'activityLocation' => $req -> activityLocation,
            'vehicleType' => $req -> vehicleType,
            'organizationPrice' => $req -> organizationPrice,
            'organizationTotalPrice' => $req -> organizationTotalPrice,
            'organizationContractStart' => $req -> organizationContractStart,
            'organizationContractEnd' => $req -> organizationContractEnd,
            'organizationContractDays' => $req -> organizationContractDays
            ]);
        }         

        $req -> session() -> flash('message', 'Successfully Updated');
        return redirect('Organization');
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
