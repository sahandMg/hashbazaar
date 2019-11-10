<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class minerTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function test_login(){
        $this->browse(function (Browser $browser) {

                // ->visit('http://192.168.100.11/cgi-bin/minerStatus.cgi')
            $browser->visit('http://192.168.1.1')->pause(5000);
            $browser->dismissDialog('Cancel');
        });


    }

}
