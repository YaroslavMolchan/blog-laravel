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
                    <?= $category->name ?> <span class="label label-default pull-right">{!! count($category->articles) !!}</span>
                </h2>
            </a>
        </div>
        <hr>
        @if (!\Auth::guest())
            <div class="text-center">
                <a class="btn btn-default" href="{{ action('CategoriesController@edit', ['id' => $category->id]) }}">Edit</a>
                <a class="btn btn-default ajax-delete" href="{{ url('/categories/'.$category->id) }}">Delete</a>
            </div>
        @endif
    @empty
        <p>No categories</p>
    @endforelse
@endsection

@if (!\Auth::guest())
    @section('scripts')
        @parent
        <script src="/js/bootbox.min.js"></script>
        <script src="/js/notify.min.js"></script>
    @stop
@endif