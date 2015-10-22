@include('errors.list')

<div class="form-group field-title">
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-alias">
    {!! Form::input('hidden', 'alias', null, ['class' => 'form-control', 'placeholder' => 'Alias']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-categories_id">
    {!! Form::select('categories_id', $categories, null, ['class' => 'form-control']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-tags_id">
    {!! Form::select('tags_id', $tags, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-meta_description">
    {!! Form::textarea('meta_description', null, ['placeholder' => 'Meta description', 'class' => 'form-control', 'rows' => 2]) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-short_description">
    {!! Form::textarea('short_description', null, ['placeholder' => 'Short description', 'class' => 'form-control', 'rows' => 2]) !!}
    <p class="help-block"></p>
</div>

<div class="form-group field-description">
    {!! Form::textarea('description', null) !!}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary center-block']) !!}
</div>

@section('styles')
    @parent
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link href="/css/redactor.css" rel="stylesheet" />
@stop

@section('scripts')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="/js/imperavi/redactor.min.js"></script>
    {{--<script src="/js/imperavi/lang/en.js"></script>--}}
    <script src="/js/imperavi/plugins/imagemanager/imagemanager.js"></script>
    <script src="/js/imperavi/plugins/fullscreen/fullscreen.js"></script>
    <script src="/js/imperavi/plugins/filemanager/filemanager.js"></script>
    <script>
    $(function() {
        $('.field-title input').keyup(function() {
            $('.field-alias input').val(toTranslit($(this).val()));
        });

        $('.field-description textarea').redactor({
            minHeight: 400,
            imageUpload: "{!! url('/upload/imageUpload') !!}",
            imageManagerJson: "{!! url('/upload/imageManager') !!}",
            fileUpload: "{!! url('/upload/fileUpload') !!}",
            fileManagerJson: "{!! url('/upload/fileManager') !!}",
            plugins: ["imagemanager","fullscreen", "filemanager"]
        });

        $('.field-categories_id select').select2({
            placeholder: 'Chose category'
        });
        $('.field-tags_id select').select2({
            placeholder: 'Chose tags',
        });
    });
    </script>
@stop