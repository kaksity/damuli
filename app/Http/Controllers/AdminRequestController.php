<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AdminDepartment;
use App\Models\AdminRequest;

class AdminRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $AdminRequest = AdminRequest::all();
        return view('index',['page' => 'admin request','request' => $AdminRequest]);
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
        $data = new AdminRequest;
        $data -> description = $req -> description;
        $data -> specification = $req -> specification;
        $data -> unitPrice = $req -> unitPrice;
        $data -> quanty = 'None';
        $data -> totalPrice = 'None';
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
        return redirect('admin request');
    }

    public function accept(Request $req)
    {
        if($req->status == 'Verified')$column = 'verify';
        if($req->status == 'Approved')$column = 'approve';
        if($req->status == 'Paid')$column = 'pay';

        $staff = AdminRequest::where(['id' => $req -> id])->update([
        'status' => $req -> status,
        $column => session('email')
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> status));
        return redirect('admin request');
    }

   
    public function reject(Request $req)
    {
        $staff = AdminRequest::where(['id' => $req -> id])->update([
        'status' => $req -> status
        ]);

        $req -> session() -> flash('message', 'Request '.($req -> status));
        return redirect('admin request');
    }

    public function update(Request $req)
    {
        $staff = AdminRequest::where(['id' => $req -> id])->update([
        'description' => $req -> description,
        'specification' => $req -> specification,
        'unitPrice' => $req -> unitPrice,
        'accountNumber' => $req -> accountNumber,
        'accountName' => $req -> accountName,
        'bankName' => $req -> bankName,
        'comment' => $req -> comment,
        'user' => session('email')
        ]);

        $req -> session() -> flash('message', 'Request Updated');
        return redirect('admin request');
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
        $staff = AdminRequest::find($req->id)->delete();
        
        $req -> session() -> flash('message', 'Request Removed');
        return redirect('maintenance request');
    }
}
