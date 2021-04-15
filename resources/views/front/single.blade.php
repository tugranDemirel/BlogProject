@extends('front.layout.master')

{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title',$article->title)
@section('bg',$article->image)
{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')
    <div class="col-md-9 mx-auto">
        <h2 class="section-heading">{{$article->title}}</h2>
        <p>{!! $article->content !!}</p> <br> <br>
        <span class="text-info">Okunma Sayısı: <b>{{$article->hit}}</b></span>
    </div>
    @include('front.widgets.categoryWidget')
@endsection

