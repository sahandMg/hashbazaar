<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index(){


    }

    public function transactions(){

        $transactions = DB::table('crypto_payments')->get();
        return view('admin.transactions',compact('transactions'));
    }
    /*
     * Ajax request to admin transaction page
     */
    public function getTransactions(){

        $transactions = DB::table('crypto_payments')->get()->toArray();
        return $transactions;
    }
}
