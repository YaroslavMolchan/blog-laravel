@extends('layouts.main')

@section('content')
    @forelse($articles as $article)
        <div class="post-preview">
            <a href="/post/7/bitva_titanov">
                <h2 class="post-title">Post title</h2>
                <h3 class="post-subtitle">
                    Post descriptionPost descriptionPost descriptionPost description
                </h3>
            </a>

            <p class="post-meta">by Author, 25 May 2015</p>
        </div>
        <hr>
    @empty
        <p>No posts</p>
    @endforelse
    {!! $articles->render(new \App\PaginationPresenter($articles, "&#8592; Newest Posts", "Older Posts &#8594;")) !!}
@endsection