<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AddController extends Controller
{
    public function show()
    {
        $categories = Category::get();
        $countries = Country::get();

        return view('index.add', [
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    public function store(Request $request)
    {
        $category_id = Category::where('name', $request->category)->first()->id;
        $country_id = Country::where('name', $request->country)->first()->id;

        $file = $request->image;

        $path = 'coins/'.date('F').date('Y').'/';

        $filename = Str::random(20);
        $filename_counter = 1;

        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = $filename.(string) ($filename_counter++);
        }

        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        $image = Image::make($file)->encode($file->getClientOriginalExtension(), 75);
        Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public');

        $coin = Coin::create([
            'user_id' => auth()->id(),
            'category_id' => $category_id,
            'country_id' => $country_id,
            'name' => $request->name,
            'price' => $request->price,
            'year' => $request->year,
            'condition' => $request->condition,
            'description' => $request->description,
            'image' => $fullPath,
        ]);

        return response()->view('index.thanks', compact('coin'), 200)->header("Refresh", "5;url=/");
    }
}
