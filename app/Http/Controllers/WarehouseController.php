<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\WarehouseActivity;
use App\Models\Vehicle;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('log')){return redirect('/');}
        $Product = Product::all();
        $Vehicle = Vehicle::all();
        return view('index',['page' => 'warehouse','product' => $Product,'vehicle' => $Vehicle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new Product;
        $data -> description = $req -> description;
        $data -> specification = $req -> specification;
        $data -> quanty = $req -> quanty;
        $data -> type = $req -> type;
        $data -> buyingPrice = $req -> buyingPrice;
        $data -> sellingPrice = $req -> sellingPrice;
        $data -> save();

        $req -> session() -> flash('message', 'Product Added');
        return redirect('warehouse');
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
        $staff = Product::where(['id' => $req -> id])->update([
        'description' => $req -> description,
        'specification' => $req -> specification,
        'quanty' => $req -> quanty,
        'type' => $req -> type,
        'sellingPrice' => $req -> sellingPrice,
        'buyingPrice' => $req -> buyingPrice
        ]);

        $req -> session() -> flash('message', 'Request Updated');
        return redirect('warehouse');
    }
    public function outProduct(Request $req)
    {
        $data = new WarehouseActivity;
        $data -> productId = $req -> id;
        $data -> quantity = $req -> quantity;
        $data -> sellingPrice = $req -> sellingPrice;
        $data -> totalPrice = ($req -> sellingPrice)*($req -> quantity);
        $data -> vehicleId = $req -> vehicleId;
        $data -> storekeeperId = session('email');
        $data -> receiverName = $req -> receiverName;
        $data -> receiverPhone = $req -> receiverPhone;
        $data -> type = 'Out';
        $data -> save();

        $quantity = Product::where(['id' => $req -> id])->value('quanty');
        $quantity = $quantity - ($req -> quantity);

        $data = Product::where(['id' => $req -> id])->update([
        'quanty' => $quantity
        ]);

        $req -> session() -> flash('message', 'Product Taken');
        return redirect('warehouse');
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
        $staff = Product::find($req->id)->delete();
        
        $req -> session() -> flash('message', 'Product Removed');
        return redirect('warehouse');
    }
}
