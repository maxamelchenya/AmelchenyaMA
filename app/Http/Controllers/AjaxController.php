<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bet;

class AjaxController extends Controller
{
    public function addBet(Request $request){
        $userId = auth()->user()->id;
        
        $bet = Bet::where('user_id', $userId)->where('coin_id', $request->input('coinId'))->first();

        if ($bet) {
            $bet->update([
                'price' => $request->input('price')
            ]);
        } else {
            Bet::create([
                'user_id' => $userId,
                'coin_id' => $request->input('coinId'),
                'price' => $request->input('price'),
            ]);
        }
    }
}
