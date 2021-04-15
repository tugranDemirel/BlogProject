<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($categories as $category)
                    <li  class="list-group-item"><a href="">{{$category->name}}</a><span class="badge bg-success float-right">{{$category->count()}}</span></li>
                @endforeach
            </div>
        </div>
    </div>
</div>
