<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuardianSearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGuardianSearch()
    {
      $this->visit('/')
        ->type('admin', 'name')
        ->type('laravel', 'password')
        ->press('submitButton')
        ->visit("/guardian")
        ->type('Should we stop throwing sticks for dogs?', 'q')
        ->press('submitSearch')
        ->see("Should we stop throwing sticks for dogs?");
    }
}
