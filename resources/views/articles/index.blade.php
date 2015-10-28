@extends('layouts.main')

@section('content')
    @if (!\Auth::guest())
        <div class="text-right mb_2o">
            <a class="btn btn-default" href="{{ action('ArticlesController@create') }}" role="button">Create article</a>
        </div>
    @endif
    @forelse($articles as $article)
        <div class="post-preview">
            <a href="/{!! $article->created_at->format('Y/m/d') !!}/{!! $article->alias !!}">
                <h2 class="post-title">
                    {!! $article->title !!}
                </h2>
                <h3 class="post-subtitle">
                    {!! $article->short_description !!}
                </h3>
            </a>
            <p class="post-meta">
                Posted by {!! $article->user->username !!} on {!! $article->created_at->format('F j, Y') !!}
                @if (!\Auth::guest() && !$article->is_published)
                    [unpublished]
                @endif
            </p>
        </div>
        <hr>
    @empty
        <p>No posts</p>
    @endforelse
    {!! $articles->render(new \App\PaginationPresenter($articles, "&#8592; Newest Posts", "Older Posts &#8594;")) !!}
@endsection