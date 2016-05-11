<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleUploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArticleUpload()
    {
        $user = factory(App\User::class)->create();
        $this->visit('/')
          ->type('admin', 'name')
          ->type('laravel', 'password')
          ->press('submitButton')
          ->visit("/new")
          ->type('Article Upload Test', 'title')
          ->type('http://www.artTest2.com', 'url')
          ->select("2", "country")
          ->press("submitButton")
          ->see("Article added succesfully");
        $this->visit("/admin")
              ->select('articles', 'Option')
              ->press("submitButton")
              ->see("Article Upload Test");
    }
}
