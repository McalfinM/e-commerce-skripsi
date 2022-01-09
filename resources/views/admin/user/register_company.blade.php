@extends('admin_template')
@section('content')

<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
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
    <div class="container">
        <h5>Buat Akun Perusahaan</h5>

        <form action="{{route('register_process')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" placeholder="Nama Perusahaan">
            </div>
            <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email/Email Perusahaan">
            </div>
            <div class="col-md-12 form-group">
                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
            </div>
            <div class="col-md-12 form-group">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password">
            </div>

            <input type="hidden" name="type" value="company" />
            <input type="submit" value="Register" class="btn btn-primary" />

        </form>
    </div>
    </div>

</section>
<!--================End Login Box Area =================-->



<!--================ Start footer Area  =================-->
@endsection