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
    @empty
        <p>No tags</p>
    @endforelse
@endsection