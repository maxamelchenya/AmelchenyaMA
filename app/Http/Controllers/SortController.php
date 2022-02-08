<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\Bet;
use App\Models\Category;


class SortController extends Controller
{
    public function sort(Request $request){
        if(isset($_GET["sorting"])){
            $sortString = $_GET['sorting'];
            $arr = explode(',', $_GET['sorting']);
            $tableName = current($arr);
            $direction = next($arr);
            $coins = Coin::orderBy($tableName, $direction)->paginate(5);
            $coins->appends($request->all());
            $categories = Category::get();
            $bets = Bet::where('user_id', auth()->id())->latest()->get();
            
            return view('index.catalog', [
                'coins' => $coins,
                'categories' => $categories,
                'bets' => $bets,
                'sortArr' => $sortString,
            ]);
        }else{
            return redirect('/');
        }
    }
}
