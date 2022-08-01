<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\WarehouseActivity;
use App\Models\Vehicle;
use App\Models\StorekeeperRequest;

class StorekeeperRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $StorekeeperRequest = StorekeeperRequest::all();
        return view('index',['page' => 'storekeeper request','request' => $StorekeeperRequest]);
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
        $data = new StorekeeperRequest;
        $data -> description = $req -> description;
        $data -> specification = $req -> specification;
        $data -> quanty = $req -> quanty;
        $data -> unitPrice = $req -> unitPrice;
        $data -> totalPrice = ($req -> unitPrice) * ($req -> quanty);
        $data -> accountNumber = $req -> accountNumber;
        $data -> accountName = $req -> accountName;
        $data -> bankName = $req -> bankName;
        $data -> comment = $req -> comment;
        $data -> status = 'Pending';
        $data -> user = session('email');
        $data -> verify = 'None';
        $data -> approve = 'None';
        $data -> pay = 'None';
        $data -> save();

        $req -> session() -> flash('message', 'Request Sent');
        return redirect('storekeeper request');
    }

    public function accept(Request $req)
    {
        if($req->status == 'Verified')$column = 'verify';
        if($req->status == 'Approved')$column = 'approve';
        if($req->status == 'Paid')$column = 'pay';

        $staff = StorekeeperRequest::where(['id' => $req -> id])->update([
        'status' => $req -> status,
        $column => session('email')
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> status));
        return redirect('storekeeper request');
    }

   
    public function reject(Request $req)
    {
        $staff = StorekeeperRequest::where(['id' => $req -> id])->update([
        'status' => $req -> status
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> status));
        return redirect('storekeeper request');
    }


    public function update(Request $req)
    {
        $staff = StorekeeperRequest::where(['id' => $req -> id])->update([
        'description' => $req -> description,
        'specification' => $req -> specification,
        'quanty' => $req -> quanty,
        'unitPrice' => $req -> unitPrice,
        'totalPrice' => ($req -> unitPrice) * ($req -> quanty),
        'accountNumber' => $req -> accountNumber,
        'accountName' => $req -> accountName,
        'bankName' => $req -> bankName,
        'comment' => $req -> comment,
        'user' => session('email')
        ]);

        $req -> session() -> flash('message', 'Request Updated');
        return redirect('storekeeper request');
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
        $staff = StorekeeperRequest::find($req->id)->delete();
        
        $req -> session() -> flash('message', 'Request Removed');
        return redirect('finance request');
    }
}
