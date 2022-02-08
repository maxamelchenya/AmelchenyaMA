<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class BlogController extends Controller
{
    public function list()
    {
        // получаем все новости из БД
        $articles = Article::latest()->get();

        // передаем во view blog.list переменную articles для отображения
        return view('blog.list', [
            'articles' => $articles,
        ]);
    }

    public function item($slug)
    {
        // получаем конкретную новость из БД
        $article = Article::where('slug', $slug)->first();

        // передаем во вью blog.item переменную article
        return view('blog.item', [
            'article' => $article,
        ]);
    }
}
