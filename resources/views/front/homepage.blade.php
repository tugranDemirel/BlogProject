@extends('front.layout.master')

{{-- sayfa title belirleme. (sayfaya özel) --}}
{{-- Header içerisinde bulunan title kısmında bulunan yield içerisindeki title ye karşılık gelecek olan kısım --}}
@section('title','Anasayfa')

{{-- layout icerisinde bulunan master icindeki yield e aasgıdaki alani gonderdim --}}
@section('content')
        <div class="col-md-9 mx-auto">
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Man must explore, and this is exploration at its greatest
                    </h2>
                    <h3 class="post-subtitle">
                        Problems look mighty small from 150 miles up
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on September 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        I believe every human has a finite number of heartbeats. I don't intend to waste any of mine.
                    </h2>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on September 18, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Science has not yet mastered prophecy
                    </h2>
                    <h3 class="post-subtitle">
                        We predict too much for the next year and yet far too little for the next ten.
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on August 24, 2019</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                        Failure is not an option
                    </h2>
                    <h3 class="post-subtitle">
                        Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on July 8, 2019</p>
            </div>
            <hr>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>
        </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Kategoriler
            </div>
            <div class="card-body">
                <div class="list-group">
                    <li  class="list-group-item"><a href="">Günlük Hayat</a><span class="badge bg-success float-right">12</span></li>
                    <li  class="list-group-item"><a href="">Teknolıji</a><span class="badge bg-primary float-right">12</span></li>
                    <li  class="list-group-item"><a href="">Eğitim</a><span class="badge bg-danger float-right">12</span></li>
                </div>
            </div>
        </div>
    </div>
@endsection

