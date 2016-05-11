<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use App\User;
use App\Models\Article;

class AdminController extends Controller
{
    public function index(){
      if (Auth::guest() || !Auth::user()->isAdmin() ){
        return redirect("/");
      }
      return view("admin");
    }
    public function select(Request $request){
      if (Auth::guest() || !Auth::user()->isAdmin() ){
        return redirect("/");
      }
      $selection = $request->input('Option');
      if(strcmp($selection, "users") == 0){
            return view("admin", [
              'users' => User::all()
            ]);
      }
      if(strcmp($selection, "articles") == 0){
        $articles = DB::table('articles')
          ->select('articles.id', 'title', 'url', 'articles.created_at', 'name')
          ->leftJoin('users', 'articles.user_id', '=', 'users.id')
          ->get();
            return view("admin", [
              'articles' => $articles
            ]);
      }
      return view("admin");
    }
    public function deleteItem($id, Request $request){
      if (Auth::guest() || !Auth::user()->isAdmin() ){
        return redirect("/");
      }
      $deleteId = $request->input('deleteId');
      $deleteItem = $request->input('deleteItem');
      if(strcmp($deleteItem, "user") == 0){
        $user = User::find($deleteId);
        if($user){
            $user->delete();
        }
        return redirect('/admin');
      }
      if(strcmp($deleteItem, "article") == 0){
        $article = Article::find($deleteId);
        if($article){
            $article->delete();
        }
        return redirect('/admin');
      }
      return redirect("/");
    }
    public function delete(Request $request){
      if (Auth::guest() || !Auth::user()->isAdmin() ){
        return redirect("/");
      }
      $deleteId = $request->input('deleteId');
      $deleteItem = $request->input('deleteItem');
      if(strcmp($deleteItem, "user") == 0){
        $user = User::find($deleteId);
        if($user){
            $user->delete();
            return view('new');
        }else{
          return view('home');
        }
      }
      return view("guardiansearch");
    }
}
