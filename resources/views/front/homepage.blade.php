@extends('front.layout.master')

{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title','Anasayfa')

{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')
        <div class="col-md-9 mx-auto">
            @include('front.widgets.articleList')
        </div>
@include('front.widgets.categoryWidget')
@endsection

