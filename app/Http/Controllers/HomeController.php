<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $articles = DB::table('articles')
                        ->select('articles.id', 'title', 'url', 'users.name', 'country_name', 'articles.created_at')
                        ->leftJoin('users', 'articles.user_id', '=', 'users.id')
                        ->leftJoin('countries', 'articles.country_id', '=', 'countries.id')
                        ->orderBy('created_at', 'DESC')
                        ->get();
        return view('home', [
          "articles" => $articles
        ]);
    }
    public function search(Request $request)
    {
      $title = $request->input('q');
      $articles = "";
      if(empty($title)){
        $articles = DB::table('articles')
                        ->select('articles.id', 'title', 'url', 'users.name', 'country_name', 'articles.created_at')
                        ->leftJoin('users', 'articles.user_id', '=', 'users.id')
                        ->leftJoin('countries', 'articles.country_id', '=', 'countries.id')
                        ->orderBy('created_at', 'DESC')
                        ->get();
      }else{
        $articles = DB::table('articles')
                  ->select('articles.id', 'title', 'url', 'users.name', 'country_name', 'articles.created_at')
                  ->leftJoin('users', 'articles.user_id', '=', 'users.id')
                  ->leftJoin('countries', 'articles.country_id', '=', 'countries.id')
                  ->where('title', 'like', "%$title%")
                  ->orderBy('created_at', 'DESC')
                  ->get();
      }
        return view('home', [
          "articles" => $articles
        ]);
    }
}
