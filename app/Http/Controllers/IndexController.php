<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Article;
use App\Models\Coin;
use App\Models\Category;
use App\Models\Bet;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $services = Service::take(3)->get();
        $articles = Article::latest()->take(3)->get();

        return view('index.main', [
            'sliders' => $sliders,
            'services' => $services,
            'articles' => $articles,
        ]);
    }

    public function contacts()
    {
        return view('index.contacts');
    }


    public function category()
    {
        $categories = Category::all();
        $countries = Country::all();
        $coins = Coin::with(['category', 'country', 'user'])->latest()->paginate(5);
        $bets = Bet::where('user_id', auth()->id())->latest()->get();

        return view('index.catalog', [
            'categories' => $categories,
            'countries' => $countries,
            'coins' => $coins,
            'bets' => $bets,
            'sortArr' => '',
        ]);
    }

    public function choosenCategory($id = null)
    {
        $categories = Category::all();
        $countries = Country::all();
        $coins = Coin::where('category_id', $id)->paginate(5);
        $bets = Bet::where('user_id', auth()->id())->latest()->get();

        return view('index.catalog', [
            'coins' => $coins,
            'categories' => $categories,
            'countries' => $countries,
            'bets' => $bets,
            'sortArr' => 'id,asc',
        ]);
    }

    public function choosenCountry($id = null)
    {
        $categories = Category::all();
        $countries = Country::all();
        $coins = Coin::where('country_id', $id)->paginate(5);
        $bets = Bet::where('user_id', auth()->id())->latest()->get();

        return view('index.catalog', [
            'coins' => $coins,
            'categories' => $categories,
            'countries' => $countries,
            'bets' => $bets,
            'sortArr' => 'id,asc',
        ]);
    }


    public function choosenPrice($price = null)
    {
        if (str_contains($price, '<')) {
            $priceArr = [0, mb_strcut($price, 1)];
        } elseif (str_contains($price, '>')) {
            $priceArr = [mb_strcut($price, 1), 99999];
        } elseif (str_contains($price, '-')) {
            $priceArr = explode("-", $price);
        } else {
            abort(404, 'Page Not Found');
        };

        $categories = Category::all();
        $countries = Country::all();
        $coins = Coin::whereBetween('price', $priceArr)->paginate(5);
        $bets = Bet::where('user_id', auth()->id())->latest()->get();

        return view('index.catalog', [
            'coins' => $coins,
            'categories' => $categories,
            'countries' => $countries,
            'bets' => $bets,
            'sortArr' => 'id,asc',
        ]);
    }

    public function services()
    {
        $services = Service::get();

        return view('index.services', [
            'services' => $services,
        ]);
    }
}
