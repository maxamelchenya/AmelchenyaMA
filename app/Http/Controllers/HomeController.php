<?php

namespace App\Http\Controllers;

use App\Helpers\GraphicHelper;
use App\Models\Coin;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        $coins = Coin::with(['category'])
            ->has('category')
            ->orderBy('created_at')
            ->get();


        $categories = $coins
            ->map(function ($item) {
                return $item->category;
            })
            ->unique();


        $gh = new GraphicHelper();
        $colorsConfiguration = $gh->getAvailableColors();
        $dataForUsersGraphics = $gh->getDataForUsersGraphics($users);
        $dataForAdsMonthGraphics = $gh->getDataForAdsMonthGraphics($coins);

        $avgSumMonth = [];
        $arr = [];
        foreach ($categories as $category) {
            $arr[$category->name] = $coins->where('category_id', $category->id)->pluck('price')->toArray();
            $avgSumMonth[$category->name] = array_sum($arr[$category->name]) / count($arr[$category->name]);
        }

        $arr = [];
        $avgSumCategory = [];

        $coins = $coins->where('created_at', '>', now()->subMonths(10)->format('Y-m'));

        foreach ($coins as $coin) {
            $coinYear = date('Y-m', strtotime($coin->created_at));
            if (isset($arr[$coinYear][$coin->category->name])) {
                $arr[$coinYear][$coin->category->name] += $coin->price;
                $arr[$coinYear][$coin->category->name . '_count']++;
            } else {
                $arr[$coinYear][$coin->category->name] = $coin->price;
                $arr[$coinYear][$coin->category->name . '_count'] = 1;
            }
        }

        $avgSum = [];
        foreach ($arr as $key => $value) {
            foreach ($value as $category => $price) {
                if (str_ends_with($category, '_count')) {
                    continue;
                }
                $avgSumCategory[$category] = $price;
                $avgSumCategory[$category . '_avg'] = $price / $value[$category . '_count'];
            }
            $avgSum[$key] = $avgSumCategory;
        }

        $period = range(1, 11);
        $avgPeriod = array_sum($period) / count($period);

        $periodIndex = 1;
        $a = [];
        $b = [];
        $upArr = [];
        $downArr = [];
        foreach ($avgSum as $key => $value) {
            foreach ($value as $avg_category => $price) {
                if (str_ends_with($avg_category, '_avg')) {
                    continue;
                }
                $a[$avg_category . '_up'] = ($periodIndex - $avgPeriod) * ($price - $avgSumMonth[$avg_category]);
                $a[$avg_category . '_square'] = pow(($periodIndex - $avgPeriod), 2);
                $periodIndex++;

                if (isset($upArr[$avg_category])) {
                    $upArr[$avg_category] += $a[$avg_category . '_up'];
                } else {
                    $upArr[$avg_category] = $a[$avg_category . '_up'];
                }

                if (isset($downArr[$avg_category])) {
                    $downArr[$avg_category] += $a[$avg_category . '_square'];
                } else {
                    $downArr[$avg_category] = $a[$avg_category . '_square'];
                }
            }
            $periodIndex++;
            $b[$key] = $a;
        }

        $rateB = [];
        foreach ($upArr as $category => $amount) {
            $rateB[$category] = $upArr[$category] / $downArr[$category];
        }

        $rateA = [];
        foreach ($rateB as $category => $amount) {
            $rateA[$category] = $avgSumMonth[$category] - $rateB[$category] * $avgPeriod;
        }

        $final = [];
        foreach (range(11, 12) as $period) {
            foreach ($rateA as $category => $amount) {
                $final[$category][$period] = $rateA[$category] * $period / 10 + $rateB[$category];
            }
        }

        $dataForCategoryPriceGraphics = $gh->getDataForCategoryPriceGraphics($coins, $final);

        return view('home', [
            'dataForFourthGraphicsData' => $dataForUsersGraphics['data'],
            'dataForCategoryPriceGraphicsData' => $dataForCategoryPriceGraphics['data'],
            'dataForCategoryPriceGraphicsLineNames' => $dataForCategoryPriceGraphics['linesConfiguration'],
            'dataForAdsMonthGraphicsData' => $dataForAdsMonthGraphics['data'],
            'colorsConfiguration' => $colorsConfiguration,
        ]);
    }
}
