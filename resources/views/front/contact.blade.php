@extends('front.layout.master')

{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title','İletişim')
@section('bg','https://www.sembolnakliyat.com/wp-content/uploads/2017/09/contact-us-banner.jpg')
{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')

    <div class="col-md-8 mx-auto">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Bizimle hemen iletişime geçin.</p>
        <form name="sentMessage" id="contactForm" method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" placeholder="Ad Soyadız" id="name" required >
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Email Adresi</label>
                    <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email Adresiniz" id="email" required >
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12 ">
                    <label>Konu</label>
                    <select class="form-control" name="topic" id="">
                        <option @if(old('topic') == 'Bilgi') selected @endif value="Bilgi">Bilgi</option>
                        <option @if(old('topic') == 'Destek') selected @endif value="Destek">Destek</option>
                        <option @if(old('topic') == 'Genel') selected @endif value="Genel">Genel</option>
                    </select>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <label>Mesaj</label>
                    <textarea rows="5" class="form-control" name="message" placeholder="Mesajınız" id="message" >{{old('message')}}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <button type="submit" name="send" class="btn btn-primary" id="sendMessageButton">Gönder</button>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body"></div>
            Adres: kashdakhd
        </div>
    </div>
@endsection
