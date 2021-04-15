@extends('front.layout.master')
{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title',$page->title)
@section('bg',$page->image)
{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>{!! $page->content !!}}</p>
        </div>
@endsection

