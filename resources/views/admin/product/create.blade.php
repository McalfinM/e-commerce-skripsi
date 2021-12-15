@extends('admin_template')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Produk</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('create_product_process')}} " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-lg-6">
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nama" />
            </div>
            <div class="form-group col-lg-6">
                <input type="number" min="0" class="form-control" name="price" value="{{old('price')}}" placeholder="Harga" />
            </div>
            <div class="form-group col-lg-6">
                <input type="number" min="0" class="form-control" name="stock" value="{{old('stock')}}" placeholder="Stok Barang" />
            </div>
            <div class="card-body">
                <textarea name="description" id="summernote">
                {{old('description')}}

                </textarea>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Masukan Gambar Produk</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <div class="col-md-12 mb-2">
                    <img id="preview-image-before-upload" src="http://lpm.unidayan.ac.id/asset/img/artikel/default.jpg" alt="preview image" style="max-height: 250px;">
                </div>

            </div>

        </div>
        <div class="col-lg-5">
            <input type="submit" class="btn btn-primary" style="right: 0px;" value="Tambah Produk" />
        </div>
    </form>

</div>


@endsection