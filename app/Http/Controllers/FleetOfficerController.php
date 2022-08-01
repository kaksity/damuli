<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FleetOfficer;
use App\Models\Organization;

class FleetOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $fleetOfficer = FleetOfficer::all();
        return view('index',['page' => 'fleet Officer','fleetOfficers' => $fleetOfficer]);
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
        if (User::where(['email' => $req -> email])->exists()) {
            $req -> session() -> flash('message', 'User Already Exits');
            return redirect('fleet Officer');
        }else{
           // return 'no';
        $staff = new User;
        $staff -> email = $req -> email;
        $staff -> password = Hash::make($req->password);
        $staff -> accType = 'Fleet Officer';
        $staff -> position = 'Fleet Officer';
        $staff -> status = '1';
        $staff -> save();
        
        $user_id = User::where(['email' => $req -> email])->value('id');
        $staff = new FleetOfficer;
        $staff -> firstName = $req -> firstName;
        $staff -> lastName = $req -> lastName;
        $staff -> phone = $req -> phone;
        $staff -> email = $req -> email;
        $staff -> address = $req -> address;
        $staff -> userId = $user_id;
        $staff -> position = 'Fleet Officer';
        $staff -> organizationId = 'Not Set';
        $staff -> save();        

        $req -> session() -> flash('message', 'Fleet Officer Added');
        return redirect('fleet Officer');
        }
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
        $staff = User::find($req -> user_id);
        $staff -> email = $req -> email;
        $staff -> save();

        $staff = FleetOfficer::where(['userId' => $req -> user_id])->update([
        'firstName' => $req -> firstName,
        'lastName' => $req -> lastName,
        'phone' => $req -> phone,
        'email' => $req -> email,
        'address' => $req -> address
        ]);       

        $req -> session() -> flash('message', 'Fleet Officer Updated');
        return redirect('fleet Officer');
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
        $staff = FleetOfficer::where(['userId' => $req -> user_id])->delete();
        $staff = User::find($req->user_id)->delete();
        $req -> session() -> flash('message', 'Fleet Officer Removed');
        return redirect('fleet Officer');
    }
}
