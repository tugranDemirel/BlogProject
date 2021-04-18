@extends('back.layout.master')
@section('title', "'".$page->title."' başlıklı sayfayı düzenle.")
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield("'".$page->title."' başlıklı sayfayı düzenle.")</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="aler alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form action="{{route('admin.page.edit.post', $page->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Makale Başlığı</label>
                    <input type="text" name="title" value="{{$page->title}}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Makale Görsel Seç</label> <br>
                    <img src="{{asset('uploads/'.$page->image)}}" class="img-thumbnail img-fluid " width="400" alt=""> <br> <br>
                    <input type="file" name="image" class="form-control">
                    <small>Dosya boyutu en fazla 2MB olmalıdır.</small>
                </div>
                <div class="form-group">
                    <label for="">Makale İçeriği</label>
                    <textarea name="contentt" id="" cols="30" rows="10" class="form-control summernote">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Makaleyi Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            'height':700
        });
    });
</script>
@endsection
