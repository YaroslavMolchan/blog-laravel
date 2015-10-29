@extends('layouts.main')

@section('content')
    @if (!\Auth::guest())
        <div class="text-right mb_2o">
            <a class="btn btn-default" href="{{ action('TagsController@create') }}" role="button">Create tag</a>
        </div>
    @endif
    @forelse($tags as $tag)
        <div class="post-preview">
            <a href="/tags/<?= $tag->name ?>">
                <h2 class="post-subtitle">
                <?= $tag->name ?> <span class="label label-default pull-right">{!! count($tag->articles) !!}</span>
                </h2>
            </a>
        </div>
        <hr>
        @if (!\Auth::guest())
            <div class="text-center">
                <a class="btn btn-default" href="{{ action('TagsController@edit', ['id' => $tag->id]) }}">Edit</a>
                <a class="btn btn-default ajax-delete" href="{{ url('/tags/'.$tag->id) }}">Delete</a>
            </div>
        @endif
    @empty
        <p>No tags</p>
    @endforelse
@endsection

@if (!\Auth::guest())
    @section('scripts')
        @parent
        <script src="/js/bootbox.min.js"></script>
        <script src="/js/notify.min.js"></script>
    @stop
@endif