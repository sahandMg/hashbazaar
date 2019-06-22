<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_successful_login()
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('/login')
            ->assertSee('Log In')
                ->type('email','s23.moghadam@gmail.com')
                ->type('password','123456')
                ->press('LOG IN')
                ->assertPathIs('/panel/dashboard');
        });
    }

    public function test_unsuccessful_login()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/panel/logout')
                ->assertPathIs('/')
                ->visit('/')
                ->assertDontSee('Dashboard')
                ->visit('/login')
//                ->assertUrlIs('localhost:7000/login')
                ->type('email','s23.moghadam@gmail.com')
                ->type('password','1234567')
                ->press('LOG IN')
                ->assertPathIs('/login');
        });
    }
}
