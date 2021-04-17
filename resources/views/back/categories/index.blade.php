@extends('back.layout.master')
@section('title', 'Kategoriler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.category.create')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Kategori Adı</label>
                            <input type="text" name="category" required placeholder="Kategori İsmi Giriniz" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-block">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori Ad</th>
                                <th>Makele Sayısı</th>
                                <th>Durum</th>
                                <th width="">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articleCount()}}</td>

                                    <td width="15">
                                        <input class="switch" category-id="{{$category->id}}" type='checkbox' data-offstyle='danger' data-on='Aktif' data-off='Pasif' @if($category->status == 1) checked @endif data-toggle='toggle' data-onstyle='success'>
                                    </td>
                                    <td>
                                        <a title="Görüntüle" href="{{route('single', [$category->slug, $category->slug])}}" target="_blank" class="btn btn-success"> <i class="fa fa-eye"></i></a>
                                        <a title="Düzenle" href="{{route('admin.makaleler.edit', $category->id)}}" class="btn btn-primary"> <i class="fa fa-pen"></i></a>
                                        <a title="Sil" href="{{route('admin.makaleler.edit', $category->id)}}" class="btn btn-danger"> <i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                id =  $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked')
                $.get("{{route('admin.category.switch')}}", {id:id, statu:statu}, function(data, status){
                    console.log(data);
                });
            })
        })
    </script>
@endsection
