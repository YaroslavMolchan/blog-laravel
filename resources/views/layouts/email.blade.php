<h2>{!! $article->title !!}</h2>
{!! $article->short_description !!}
<br>
<a href="{!! url() !!}/{!! $article->created_at->format('Y/m/d') !!}/{!! $article->alias !!}">Read more</a>
<br>
<a href="{!! url() !!}/unsubscribe/{!! base64_encode($subscriber->email) !!}">Unsubscribe</a>