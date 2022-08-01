<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FleetOfficer;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function authentication(Request $req)
    {
        $check = Hash::check($req->password, User::where(['email' => $req -> email])->value('password'));
        if (User::where(['email' => $req -> email])->exists() && $check == 1) {
            $req -> session() -> flash('message', 'Successfully Login');
            $req -> session() -> put('log', '1');
            $req -> session() -> put('email', $req -> email);
            $req -> session() -> put('accType', User::where(['email' => $req -> email])->value('accType'));
            $req -> session() -> put('user_id', User::where(['email' => $req -> email])->value('id'));
            $req -> session() -> put('position', User::where(['email' => $req -> email])->value('position'));
            $req -> session() -> put('fleetId', FleetOfficer::where(['email' => $req -> email])->value('id'));
            return redirect('Dashboard');
        }else{
            $req -> session() -> flash('message', 'Wrong Email Or Password');
            return redirect('/');
        }
    }

    public function destroy($id)
    {
        //
    }
}
