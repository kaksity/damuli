<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FuelRequest;
use App\Models\FuelDepartment;

class FuelRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(!session()->has('log')){return redirect('/');}
        $FuelRequest = FuelRequest::all();
        return view('index',['page' => 'fuel request','fuelRequest' => $FuelRequest]);
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

        $fillingStationId = FuelDepartment::where(['email' => session('email')])->value('fillingStationId');
        $data = new FuelRequest;
        $data -> fillingStationId = $fillingStationId;
        $data -> fuelLitre = $req -> fuelLitre;
        $data -> fuelPrice = $req -> fuelPrice;
        $data -> fuelTotalPrice = $req -> fuelTotalPrice;
        $data -> accountNumber = $req -> accountNumber;
        $data -> accountName = $req -> accountName;
        $data -> bankName = $req -> bankName;
        $data -> fuelComment = $req -> comment;
        $data -> fuelRequestStatus = 'Pending';
        $data -> user = session('email');
        $data -> verify = 'None';
        $data -> approve = 'None';
        $data -> pay = 'None';
        $data -> save();

        $req -> session() -> flash('message', 'Request Sent');
        return redirect('fuel request');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $req)
    {
        if($req->fuelRequestStatus == 'Verified')$column = 'verify';
        if($req->fuelRequestStatus == 'Approved')$column = 'approve';
        if($req->fuelRequestStatus == 'Paid')$column = 'pay';

        $staff = FuelRequest::where(['id' => $req -> id])->update([
        'fuelRequestStatus' => $req -> fuelRequestStatus,
        $column => session('email')
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> fuelRequestStatus));
        return redirect('fuel request');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $req)
    {
        $staff = FuelRequest::where(['id' => $req -> id])->update([
        'fuelRequestStatus' => $req -> fuelRequestStatus
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> fuelRequestStatus));
        return redirect('fuel request');
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
        $staff = FuelRequest::where(['id' => $req -> id])->update([
        'fuelLitre' => $req -> fuelLitre,
        'fuelPrice' => $req -> fuelPrice,
        'fuelTotalPrice' => $req -> fuelTotalPrice,
        'accountNumber' => $req -> accountNumber,
        'accountName' => $req -> accountName,
        'bankName' => $req -> bankName,
        'fuelComment' => $req -> comment,
        'user' => session('email')
        ]);

        $req -> session() -> flash('message', 'Request Updated');
        return redirect('fuel request');
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
