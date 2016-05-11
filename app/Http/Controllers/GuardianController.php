<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cache;

class GuardianController extends Controller
{
    public function index(){
      $articles = [];
      return view('guardiansearch', [
        'articles' => $articles
        ]);
    }

    public function search(Request $request){
    //Example API call: https://content.guardianapis.com/search?api-key=d0b9791c-ec21-44dc-b514-19dd1aa1885e
      $API_Key = "d0b9791c-ec21-44dc-b514-19dd1aa1885e";
      $query = $request->input('q');
      $query = str_replace(" ", "+", $query);
      if(Cache::has($query)){
        $json = Cache::get($query);
        foreach ($json->response->results as $result){
            $articles[] = $result;
        }
        return view('guardiansearch', [
          'articles' => $articles,
          'json' => $json,
          'query' => $query
          ]);
      }
      $url =  "https://content.guardianapis.com/search?api-key=$API_Key&q=$query";
      $results = file_get_contents($url);
      $json = json_decode($results);
      Cache::put($query, $json, 60);
      $articles = [];

      foreach ($json->response->results as $result){
          $articles[] = $result;
      }
      return view('guardiansearch', [
        'articles' => $articles,
        'json' => $json,
        'query' => $query
        ]);
    }
}
