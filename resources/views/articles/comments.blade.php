@forelse($article->comments as $comment)
    <div class="comment">
        {!! \App\Helper::gravatar($comment->email) !!}
        <div class="header">
            @if($comment->url && $comment->status == 1)
                {!! Html::link($comment->url, $comment->username, ['target' => '_blank']) !!}
            @elseif($comment->url && !\Auth::guest())
                {!! $comment->username !!} <small>{!! Html::link($comment->url, $comment->url, ['target' => '_blank']) !!}</small>
            @else
                {!! $comment->username !!}
            @endif
            <span class="pull-right">{!! $comment->created_at->diffForHumans() !!}</span>
        </div>
        <div class="text">
            {!! $comment->comment !!}
        </div>
        @if (!\Auth::guest())
            <hr>
            <div class="text-center">
                @if ($comment->url)
                    {!! Html::link(action('ArticlesController@urlComment', ['id' => $comment->id]), ($comment->status == 1 ? 'Deny' : 'Allow'). ' link', ['class'=>'btn btn-small btn-default ajaxRequest']) !!}
                @endif
                {!! Html::link(action('ArticlesController@updateComment', ['id' => $comment->id]), 'Edit', ['class'=>'btn btn-small btn-default ajaxEdit']) !!}
                {!! Html::link(action('ArticlesController@deleteComment', ['id' => $comment->id]), 'Delete', ['class'=>'btn btn-small btn-default ajaxRequest']) !!}
            </div>
        @endif
    </div>
@empty
    Empty
@endforelse