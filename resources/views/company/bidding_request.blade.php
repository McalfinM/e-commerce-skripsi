@extends('admin_template')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">List Request Penawaran Harga</h1>
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

    <table class="table table-sm">
        <thead>
            <tr>

                <th scope="col">Order Number</th>
                <th scope="col">Status</th>
                <th scope="col">Quantity</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($data !== null)

            @foreach($data as $datas)
            <tr>
                <th scope="row">{{$datas->order_number}}</th>
                <td>
                    @if($datas->status == 'Request Price')
                    Pending
                    @else
                    {{$datas->status}}
                    @endif
                </td>
                <td>{{$datas->quantity}}</td>

                <td><a href="{{route('detail_list_bidding_price',$datas->id)}}" class="btn btn-primary">Detail</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</div>


@endsection