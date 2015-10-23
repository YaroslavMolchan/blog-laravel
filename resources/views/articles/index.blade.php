@extends('layouts.main')

@section('content')
    @forelse($articles as $article)
        <div class="post-preview">
            <a href="/{!! $article->created_at->format('Y/m/d') !!}/{!! $article->alias !!}">
                <h2 class="post-title">{!! $article->title !!}</h2>
                <h3 class="post-subtitle">
                    {!! $article->short_description !!}
                </h3>
            </a>
            <p class="post-meta">by {!! $article->user->username !!}, {!! $article->created_at->format('j M Y') !!}</p>
        </div>
        <hr>
    @empty
        <p>No posts</p>
    @endforelse
    {!! $articles->render(new \App\PaginationPresenter($articles, "&#8592; Newest Posts", "Older Posts &#8594;")) !!}
@endsection