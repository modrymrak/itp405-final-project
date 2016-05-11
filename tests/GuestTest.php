<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see("login");
        $this->visit('/new')
            ->see("login");
        $this->visit('/guardian')
            ->see("login");
        $this->visit('/admin')
            ->see("login");
    }
}
