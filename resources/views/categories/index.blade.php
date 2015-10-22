@extends('layouts.main')

@section('content')
    @if (!\Auth::guest())
        <div class="text-right mb_2o">
            <a class="btn btn-default" href="{{ action('CategoriesController@create') }}" role="button">Create category</a>
        </div>
    @endif
    @forelse($categories as $category)
        <div class="post-preview">
            <a href="/categories/<?= $category->name ?>">
                <h2 class="post-subtitle">
                <?= $category->name ?> <span class="label label-default pull-right">0</span>
                </h2>
            </a>
        </div>
        <hr>
    @empty
        <p>No categories</p>
    @endforelse
@endsection