@forelse($article->comments as $comment)
    <div class="comment">
        {!! \App\Helper::gravatar($comment->email) !!}
        <div class="header">
            @if($comment->url && $comment->status == 1)
                {!! Html::link($comment->url, $comment->username, ['target' => '_blank']) !!}
            @elseif($comment->url && !\Auth::guest())
                {{ $comment->username }} <small>({!! Html::link($comment->url, $comment->url, ['target' => '_blank']) !!})</small>
            @else
                {{ $comment->username }}
            @endif
            <span class="pull-right">{!! $comment->created_at->diffForHumans() !!}</span>
        </div>
        <div class="text">
            {{ $comment->comment }}
        </div>
        @if (!\Auth::guest())
            <hr>
            <div class="text-center">
                @if ($comment->url)
                    {!! Html::link(action('ArticlesController@urlComment', ['id' => $comment->id]), ($comment->status == 1 ? 'Deny' : 'Allow'). ' link', ['class'=>'btn btn-small btn-default ajaxRequest']) !!}
                @endif
                {!! Html::link(action('ArticlesController@deleteComment', ['id' => $comment->id]), 'Delete', ['class'=>'btn btn-small btn-default ajaxRequest']) !!}
            </div>
        @endif
    </div>
@empty
    No comments
@endforelse
{{--Form--}}
<hr>
<h2 class="text-center">Add your comment:</h2>
{!! Form::open(['action' => ['ArticlesController@createComment', 'id' => $article->id], 'class' => 'comment-form']) !!}
    <div class="form-group field-username">
        {!! Form::text('username', Cookie::get('username'), ['class' => 'form-control', 'placeholder' => 'Username']) !!}
        <p class="help-block"></p>
    </div>

    <div class="form-group field-email">
        {!! Form::text('email', Cookie::get('email'), ['class' => 'form-control', 'placeholder' => 'Email (nobody see it)']) !!}
        <p class="help-block"></p>
    </div>

    <div class="form-group field-url">
        {!! Form::text('url', Cookie::get('url'), ['class' => 'form-control', 'placeholder' => 'Your website (optional)']) !!}
        <p class="help-block"></p>
    </div>

    <div class="form-group field-comment">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Comment']) !!}
        <p class="help-block"></p>
    </div>

    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary center-block']) !!}
    </div>
{!! Form::close() !!}