@extends('welcome')
@section('content')
    <section id="page-content">
        <div class="container">
            <div class="page-title">
                <h1>Новости из мира монет</h1>
            </div>
            <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
                @foreach ($articles as $article)
                    <div class="post-item border">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="{{asset('blog/'.$article->slug)}}">
                                    <img alt="" src="{{ Voyager::image( $article->image ) }}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{ $article->created_at }}</span>
                                <h2><a href="{{asset('blog/'.$article->slug)}}">{!! $article->title !!}</a></h2>
                                <p>{{ $article->excerpt }}</p>
                                <a href="{{asset('blog/'.$article->slug)}}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
