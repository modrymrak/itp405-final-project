<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Country;
use Auth;
use Validator;
use DB;

class MainController extends Controller
{
    public function index(){
      $articles = DB::table('articles')->get();
      return view("main", [
          'myArticles' => $articles
      ]);
    }

    public function newArticle(Request $request){
      return view('new', [
        'countries' => Country::all()
      ]);
    }

    public function addArticle(Request $request){
      $country = new Country();
      $validation = Validator::make($request->all(), [
        'title' => 'required',
        'url' => 'required|url',
        'country' => 'required',
      ]);
      $guardian = $request->input("guardian");
      if($validation->fails() || $guardian){
        return redirect("new")->withErrors($validation)->withInput();
      }
      $article = new Article();
      $article->title = $request->input("title");
      $article->url = $request->input("url");
      $article->country_id = $request->input("country");
      $article->user_id = Auth::user()->id;
      $article->save();
      return view('new', [
        'countries' => $country->all(),
        'success'   => true
      ]);
    }

    public function articleDetails($id, Request $request){
      $article = DB::table('articles')
                      ->select('articles.id', 'title', 'url', 'users.name', 'country_name', 'articles.created_at')
                      ->leftJoin('users', 'articles.user_id', '=', 'users.id')
                      ->leftJoin('countries', 'articles.country_id', '=', 'countries.id')
                      ->orderBy('created_at', 'DESC')
                      ->where('articles.id', '=', "$id")
                      ->get();
      if(!$article){
        redirect("/");
      }
      $comments = DB::table('comments')
              ->select('text', 'user_name', 'created_at')
              ->where('article_id', '=', "$id")
              ->orderBy('created_at', 'DESC')
              ->get();

      return view('details', [
        'article' => $article,
        'comments' => $comments,
        'id' => $id
      ]);
    }

    public function newComment($id, Request $request){
      $article = DB::table('articles')
                      ->select('articles.id', 'title', 'url', 'users.name', 'country_name', 'articles.created_at')
                      ->leftJoin('users', 'articles.user_id', '=', 'users.id')
                      ->leftJoin('countries', 'articles.country_id', '=', 'countries.id')
                      ->orderBy('created_at', 'DESC')
                      ->where('articles.id', '=', "$id")
                      ->get();
      if(!$article){
        redirect("/");
      }
      $validation = Validator::make($request->all(), [
        'content' => 'required|string',
      ]);
      if($validation->fails() || Auth::guest()){
        return redirect("/article/$id")->withErrors($validation)->withInput();
      }
      $comment = new Comment();
      $comment->text = $request->input("content");
      $comment->user_name = Auth::user()->name;
      $comment->article_id = $id;
      $comment->save();
      $comments = DB::table('comments')
              ->select('text', 'user_name', 'created_at')
              ->where('article_id', '=', "$id")
              ->orderBy('created_at', 'DESC')
              ->get();
      return view('details', [
        'article' => $article,
        'comments' => $comments,
        'id' => $id
      ]);
    }
}
