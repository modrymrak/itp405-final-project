<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {
      $this->visit('/')
        ->type('admin', 'name')
        ->type('laravel', 'password')
        ->press('submitButton')
        ->seePageIs('/');
      $this->visit('/')
        ->click('logoutButton')
        ->seePageIs('/login');
        $this->visit('/login')
          ->type('test', 'name')
          ->type('test1234', 'password')
          ->press('submitButton')
          ->seePageIs('/');
    }
}
