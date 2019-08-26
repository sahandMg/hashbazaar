<?php

namespace App\Http\Controllers\Remote;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index(){

        return view('remote.panel.subscription');
    }
}
