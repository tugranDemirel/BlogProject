@extends('back.layout.master')
@section('title', 'Ayarlar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>
        </div>
        <div class="card-body">
                <form action="{{route('admin.config.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Başlığı</label>
                                <input type="text" name="title" value="{{$config->title}}" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Site Aktiflik Durumu</label>
                                <select class="form-control" name="active" id="">
                                    <option @if($config->active == 1) selected @endif value="1">Açık</option>
                                    <option @if($config->active == 0) selected @endif value="0">Kapalı</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Site Logosu</label>
                                <input type="file" name="logo"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Site Favicon</label>
                                <input type="file" name="favicon"  class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Facebook Linki</label>
                                <input type="text" name="facebook" value="{{$config->facebook}}" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Twitter Linki</label>
                                <input type="text" name="twitter" value="{{$config->twitter}}" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Github Linki</label>
                                <input type="text" name="github" value="{{$config->github}}" id="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Linkedin Linki</label>
                                <input type="text" name="linkedin" value="{{$config->linkedin}}" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Youtube Linki</label>
                                <input type="text" name="youtube" value="{{$config->youtube}}" id="" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">İnstagram Linki</label>
                                <input type="text" name="instagram" value="{{$config->instagram}}" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block" name="Güncelle">Güncelle</button>
                    </div>
                </form>
        </div>
    </div>
@endsection
