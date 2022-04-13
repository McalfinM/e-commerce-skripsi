<section>
    <br>
    <div class="container-fluid">
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



        <h5>Ubah Profil</h5>
        <div class="card">
            <div class="m-2">
                <input class="form-control" placeholder="Masukan nama perusahaan" />
            </div>
            <div class="m-2">
                <input class="form-control" placeholder="Masukan nomor telfon" />
            </div>
            <div class="m-2">
                <input class="form-control" placeholder="Masukan alamat perusahaan" />
            </div>
            <div class="m-2">
                <input class="form-control" type="file" />
            </div>
        </div>

    </div>

    </div>
</section>