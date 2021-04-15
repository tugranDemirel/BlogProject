
@if(count($articles) > 0)
    @foreach($articles as $article)
        <div class="post-preview">
            <img src="{{$article->image}}" alt="">
            <a href="{{route('single', [$article->getCategory->slug, $article->slug])}}">
                <h2 class="post-title">
                    {{$article->title}}
                </h2>
                <h3 class="post-subtitle">
                    {!! str_limit($article->content, 80) !!}
                </h3>
            </a>
            <p class="post-meta">
                <a href="#">{{$article->getCategory->name}}</a>
                <span class="float-right">{{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach
    <!-- Pager -->
    {{--Pagination--}}
    <div class="">
        {{$articles->links()}}
    </div>
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı</h1>
    </div>
@endif
