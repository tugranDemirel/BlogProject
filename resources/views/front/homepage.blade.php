@extends('front.layout.master')

{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title','Anasayfa')

{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')
        <div class="col-md-9 mx-auto">
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

        </div>
@include('front.widgets.categoryWidget')
@endsection

