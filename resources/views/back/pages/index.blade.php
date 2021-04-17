@extends('back.layout.master')
@section('title', 'Tüm Sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}} sayfa bulundu.</strong></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($pages as $page)
                    <tr>
                        <td>
                            <img src="{{asset('uploads/'.$page->image)}}" width="75" alt="{{$page->baslik}}">
                        </td>
                        <td>{{$page->title}}</td>
                        <td width="15">
                            <input class="switch" page-id="{{$page->id}}" type='checkbox' data-offstyle='danger' data-on='Aktif' data-off='Pasif' @if($page->status == 1) checked @endif data-toggle='toggle' data-onstyle='success'>
                        </td>
                        <td>
                            <a title="Görüntüle" href="{{route('page', $page->slug)}}" target="_blank" class="btn btn-success"> <i class="fa fa-eye"></i></a>
                            <a title="Düzenle" href="{{route('admin.makaleler.edit', $page->id)}}" class="btn btn-primary"> <i class="fa fa-pen"></i></a>
                            <a title="Düzenle" href="{{route('admin.makaleler.edit', $page->id)}}" class="btn btn-danger"> <i class="fa fa-times"></i></a>
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
    <script>
        $(function() {
            $('.switch').change(function() {
               id =  $(this)[0].getAttribute('page-id');
               statu = $(this).prop('checked')
                $.get("{{route('admin.page.switch')}}", {id:id, statu:statu}, function(data, status){
                    console.log(data);
                });
            })
        })
    </script>
@endsection
