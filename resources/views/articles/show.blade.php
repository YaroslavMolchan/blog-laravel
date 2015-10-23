@extends('layouts.main')

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