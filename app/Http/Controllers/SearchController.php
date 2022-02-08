<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\Category; 
use App\Models\Bet;

class SearchController extends Controller
{
    public function search(Request $request){
        if(isset($_GET['query']) && strlen($_GET['query']) > 0){
            $search_text = $_GET['query'];
            $coins = Coin::where('name','LIKE','%'.$search_text.'%')->paginate(5);
            $coins->appends($request->all());
            $categories = Category::get();
            $bets = Bet::where('user_id', auth()->id())->latest()->get();
            
            return view('index.catalog', [
                'coins' => $coins,
                'categories' => $categories,
                'bets' => $bets,
                'sortArr' => '',
            ]);
        }else{
            return redirect('/');
        }
    }
}
