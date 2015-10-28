@extends('layouts.main')

@section('content')
    @if (!\Auth::guest())
        <div class="text-right mb_2o">
            <a class="btn btn-default" href="{{ action('CategoriesController@create') }}" role="button">Create category</a>
        </div>
    @endif
    @forelse($categories as $category)
        <div class="post-preview" data-toggle="context" data-target="#context-menu{!! $category->id !!}">
            <a href="/categories/<?= $category->name ?>">
                <h2 class="post-subtitle">
                    <?= $category->name ?> <span class="label label-default pull-right">{!! count($category->articles) !!}</span>
                </h2>
            </a>
        </div>
        <div id="context-menu{!! $category->id !!}">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1" href="{{ action('CategoriesController@edit', ['id' => $category->id]) }}">Edit</a></li>
                <li><a tabindex="-1" class="ajax-delete" href="{{ url('/categories/'.$category->id) }}">Delete</a></li>
            </ul>
        </div>
        <hr>
    @empty
        <p>No categories</p>
    @endforelse
@endsection

@section('scripts')
    @parent
    <script src="/js/bootstrap-contextmenu.js"></script>
    {{--<script>--}}
        {{--$(function() {--}}
            {{--$('.field-title input').keyup(function() {--}}
                {{--$('.field-alias input').val(toTranslit($(this).val()));--}}
            {{--});--}}

            {{--$('.field-description textarea').redactor({--}}
                {{--minHeight: 400,--}}
                {{--imageUpload: "{!! url('/upload/imageUpload') !!}",--}}
                {{--imageManagerJson: "{!! url('/upload/imageManager') !!}",--}}
                {{--fileUpload: "{!! url('/upload/fileUpload') !!}",--}}
                {{--fileManagerJson: "{!! url('/upload/fileManager') !!}",--}}
                {{--plugins: ["imagemanager","fullscreen", "filemanager"]--}}
            {{--});--}}

            {{--$('.field-category_id select').select2({--}}
                {{--placeholder: 'Chose category'--}}
            {{--});--}}

            {{--$('.field-tags_id select').select2({--}}
                {{--placeholder: 'Chose tags',--}}
                {{--'tags': true--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop