@extends('back.layout.master')
@section('title', 'Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} adet silinen makale bulundu.</strong></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Silinme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="{{asset('uploads/'.$article->image)}}" width="75" alt="{{$article->baslik}}">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->deleted_at}}</td>
                        <td>
                            <a title="Geri Getir" href="{{route('admin.recover.article', $article->id)}}" class="btn btn-primary"> <i class="fa fa-recycle"></i></a>
                            <a title="Sil" href="{{route('admin.hard.delete.article', $article->id)}}" class="btn btn-danger"> <i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
