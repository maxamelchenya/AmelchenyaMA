<?php

namespace App\Helpers;

class GraphicHelper
{
    public function getDataForCategoryPriceGraphics($coins, $forecastPrice)
    {
        $dataForForecastGraphics = [];

        foreach ($forecastPrice as $category => $coinPeriods) {
            foreach ($coinPeriods as $period => $price) {
                $coinYear = $period === 11 ? now()->addMonth()->format('Y-m') : now()->addMonths(2)->format('Y-m');

                if (isset($dataForForecastGraphics[$coinYear][$category])) {
                    $dataForForecastGraphics[$coinYear][$category]+= $price;
                } else {
                    $dataForForecastGraphics[$coinYear][$category] = $price;
                    $dataForForecastGraphics[$coinYear]['y'] = $coinYear;
                }

                if (!isset($linesConfiguration[$category])) {
                    $linesConfiguration[$category]['name'] = $category;
                }
            }
        }

        $dataForCategoryPriceGraphics = [];
        $linesConfiguration = [];

        $coins = $coins->where('created_at', '>', now()->subMonths(12)->format('Y-m'));

        foreach ($coins as $coin) {
            $coinYear = date('Y-m', strtotime($coin->created_at));
            if (isset($dataForCategoryPriceGraphics[$coinYear][$coin->category->name])) {
                $dataForCategoryPriceGraphics[$coinYear][$coin->category->name] += $coin->price;
            } else {
                $dataForCategoryPriceGraphics[$coinYear][$coin->category->name] = $coin->price;
                $dataForCategoryPriceGraphics[$coinYear]['y'] = $coinYear;
            }

            if (!isset($linesConfiguration[$coin->category->name])) {
                $linesConfiguration[$coin->category->name]['name'] = $coin->category->name;
            }
        }

        return [
            'data' => array_merge($dataForCategoryPriceGraphics, $dataForForecastGraphics),
            'linesConfiguration' => $linesConfiguration
        ];
    }

    public function getDataForAdsMonthGraphics($coins)
    {
        $dataForAdsMonthGraphics = [];

        foreach ($coins as $coin) {
            $coinMonth = date('m', strtotime($coin->created_at));

            if (isset($dataForAdsMonthGraphics[$coinMonth])) {
                $dataForAdsMonthGraphics[$coinMonth]++;
            } else {
                $dataForAdsMonthGraphics[$coinMonth] = 1;
            }
        }

        ksort($dataForAdsMonthGraphics);

        return [
            'data' => $dataForAdsMonthGraphics,
        ];
    }

    public function getDataForUsersGraphics($users)
    {
        $dataForUsersGraphics = [];

        $users = $users->where('created_at', '>', now()->subMonths(12)->format('Y-m'));

        foreach ($users as $user) {
            $userMonth = date('m', strtotime($user->created_at));

            if (isset($dataForUsersGraphics[$userMonth])) {
                $dataForUsersGraphics[$userMonth]++;
            } else {
                $dataForUsersGraphics[$userMonth] = 1;
            }
        }

        ksort($dataForUsersGraphics);

        return [
            'data' => $dataForUsersGraphics,
        ];
    }

    public function getAvailableColors()
    {
        return [
            '#B042F5',
            '#F5B342',
            '#f54242',
            '#42E3F5',
            '#4275F5',
            '#4dff00',
            '#904013',
            '#E576E7',
            '#679B3A',
            '#558EA9',
            '#DEB7CB',
            '#F35A7D',
            '#602A8E',
            '#AFBEBE',
            '#F19993',
            '#69DACF',
            '#C03454',
            '#AE0BFE',
        ];
    }
}
