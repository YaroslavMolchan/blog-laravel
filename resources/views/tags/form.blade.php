@include('errors.list')

<div class="form-group field-name">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary center-block']) !!}
</div>