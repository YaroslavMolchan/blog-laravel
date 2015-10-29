@extends('layouts.main')

@section('meta')
    @parent
    <meta name="description" content="{!! $article->meta_description !!}">
    <meta name="keywords" content="{!! implode(', ', $article->tags()->lists('name')->all()) !!}">
@stop

@section('content')
<div class="post-block">
    {!! $article->description !!}
    <hr>
    Category: {!! Html::link('/categories/'.$article->category->name, $article->category->name) !!}<br />
    @if ($article->tags)
        Tags:
        @foreach($article->tags as $tag)
            {!! Html::link('/tags/'.$tag->name, $tag->name) !!}
        @endforeach
    @endif
    <hr>
    @if (!\Auth::guest())
        <div class="text-center">
            <a class="btn btn-default" href="{{ action('ArticlesController@edit', ['id' => $article->id]) }}">Edit</a>
            <a class="btn btn-default ajax-delete" href="{{ url('/articles/'.$article->id) }}">Delete</a>
        </div>
        <hr>
    @endif
</div>
<div class = "share_block">
    <div class = "share_text">Like this? Share it with friends:</div>
    <div class="share42init" data-url="{!! url() !!}" data-title="{!! $article->title !!}" data-description="{!! $article->short_description !!}" data-image="logo.jpg"></div>
    <hr>
</div>
<h2 class="section-heading">Comments:</h2>
    <div id="comments-block">
        @include('articles.comments', compact('article'))
    </div>
@endsection

@section('scripts')
    @parent
    <script src="/js/share42/share42.js"></script>
    <script src="/js/bootbox.min.js"></script>
    <script src="/js/notify.min.js"></script>
@stop