@extends('general_template')
@section('content')
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
@if(!$data)
<p>Data koosng</p>
@else
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No Invoice</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $payment)

                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="img/cart/cart1.png" alt="">
                                </div>
                                <div class="media-body">
                                    <p style="color: black;">{{$payment->no_invoice}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5>{{$payment->name}}</h5>
                        </td>
                        <td>
                            <div class="product_count">
                                <p>{{$payment->quantity}}</p>
                            </div>
                        </td>
                        <td>
                            <h5>{{$payment->rupiah()}}</h5>
                        </td>
                        <td><a class="btn btn-primary" style="color: white;">Detail</a></td>
                    </tr>
                    @endforeach




                </tbody>
            </table>
        </div>
    </div>
</section>
@endif
@endsection