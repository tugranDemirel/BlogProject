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
                                        <a title="Kategori Düzenle" category-id="{{$category->id}}" class="btn btn-primary edit-click"> <i class="fa fa-edit"></i></a>
                                        <a title="Sil" id="delete-click" class="btn btn-danger"> <i class="fa fa-times"></i></a>
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
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('admin.category.update')}}" method="post">
                    @csrf
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="">Kategori Adı</label>
                                <input type="text" name="category" id="category" class="form-control">
                                <input type="hidden" name="id" id="category_id">
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Slug Adı Düzenle</label>
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
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
            // modal icin
            $('.edit-click').click(function () {
                // category-id adindaki arttribute diye olusuturdugumuz kendi attributemiz ile kartegori id ini yakaladık.
                id =  $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url:'{{route('admin.category.getData')}}',
                    data:{id:id},
                    success:function (data) {
                        // category id ine sahip inputun içindeki veriyi db den gelen veri ile yazdirdik
                        $('#category').val(data.name);

                        // slug id ine sahip inputun içindeki veriyi db den gelen veri ile yazdirdik
                        $('#slug').val(data.slug);

                        /*  category_id id ine sahip inputun içindeki veriyi db den gelen veri ile yazdirdik
                            update için gerekli olan id */
                        $('#category_id').val(data.id);
                        $('#editModal').modal();
                    }
                });
            });

            //aktif pasif
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
