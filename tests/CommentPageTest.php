<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
      $this->visit('/')
        ->type('admin', 'name')
        ->type('laravel', 'password')
        ->press('submitButton')
        ->visit("/")
        ->click("commentFor142")
        ->see("Article comments");
    }
}
