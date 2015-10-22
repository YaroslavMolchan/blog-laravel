@extends('layouts.main')

@section('content')
    @forelse($categories as $category)
        <div class="post-preview">
            <a href="/category/<?= $category->name ?>">
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