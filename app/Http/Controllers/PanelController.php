<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function dashboard(){

        return view('panel.dashboard');
    }


    public function activity(){

        return view('panel.activity');
    }

    public function setting(){

        return view('panel.settings.setting');
    }
    public function userInfo(){

        return view('panel.settings.userInfo');
    }

    public function changePassword(){

        return view('panel.settings.changePassword');
    }

    public function wallet(){

        return view('panel.settings.wallet');
    }

    public function makeWallet(){

        return view('panel.settings.makeWallet');
    }

    public function referral(){

        return view('panel.referral');
    }

    public function contact(){

        return view('panel.contact');
    }
}
