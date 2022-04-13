@extends('admin_template')
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
@if($order->status == 'Company Deal')
<br>

<p class="btn btn-success">Perusahaan Menyetujui Harga Penawaran</p>
@endif
<h5>Order: {{$order->order_number}} Status: @if($order->status == 'Request Price') Menunggu Penawaran @else {{$order->status}} @endif</h5>
@if($order->status == 'Processed' && $order->surat_jalan !== null)
<a class="btn btn-primary" target="_blank" href="{{$order->lihat_surat()}}">Lihat Surat Jalan</a>
<a href="{{route('lihat_pesanan_pelanggan', $order->id)}}" class="btn btn-primary">Lihat Daftar Pesanan</a>
@endif

@if($order->status == 'Done')
<a class="btn btn-primary" href="{{route('list_order_inventory_pdf',$order->id)}}">Download Invoice</a>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Harga Satu Barang</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga Di Tawarkan (Rp)</th>
            @if($order->status == 'Request Price' || $order->status == 'Bidding')
            <th scope="col">Harga Sebelumnya (Rp)</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @php
        $sub_total = 0;
        @endphp
        @if($orderDetail!== null)
        @foreach($orderDetail as $detail)
        @php
        $sub_total += $detail->total_price;

        @endphp

        <tr>
            <td>
                <div class="media">
                    <div class="d-flex">
                        <img src="img/cart/cart1.png" alt="">
                    </div>
                    <div class="media-body">
                        <p style="color: black;">{{$detail->product->name}}</p>
                    </div>
                </div>
            </td>

            <td>
                <div class=" product_count">
                    <input type="hidden" class="pid" value="{{$detail['id']}}" />
                    <input style="width: 70px;" type="text" readonly name="quantity" value="{{$detail->quantity}}" class="form-control">

                </div>
            </td>
            <td>{{$detail->product->rupiah()}}</td>
            <td>{{$detail->volume}}</td>
            <td>
                @if($order->status == 'Request Price')
                <input style="width: 200px;" name="total_price" value="{{number_format($detail->total_price, 0, ',', '.');}}" class="itemQty form-control" />
                @else
                <input style="width: 200px;" readonly name="total_price" value="{{number_format($detail->total_price, 0, ',', '.');}}" class="itemQty form-control" />
                @endif
                @if($order->status == 'Request Price' || $order->status == 'Bidding')
            <td> <input style="width: 200px;" readonly name="total_price" value="{{number_format($detail->previous_price, 0, ',', '.');}}" class="form-control" /></td>
            @endif
            </td>

        </tr>

        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>

            <td>Total Harga</td>
            <td id="sub_total" style="color: black;">{{"Rp " . number_format($sub_total, 2, ',', '.');}}</td>
        </tr>

        @endif


    </tbody>
</table>
@if($order)
<div class="row">
    @if($order->status == 'Request Price')
    <form action="{{route('send_bidding_price',$order->id)}}" method="POST">
        @csrf

        <button type="submit" class="btn btn-primary">Ajukan Penawaran</button>
    </form>

    <form action="{{route('bidding_deal_admin',$order->id)}}" method="POST">
        @csrf
        <button class="btn btn-success" type="submit">Setuju</button>
    </form>
    @elseif($order->status == 'Company Deal')



    <form action="{{route('send_bidding_price',$order->id)}}" method="POST">
        @csrf

        <button type="submit" class="btn btn-primary">Ajukan Penawaran</button>
    </form>

    <form action="{{route('bidding_deal_admin',$order->id)}}" method="POST">
        @csrf
        <button class="btn btn-success" type="submit">Setuju</button>
    </form>
    @endif
</div>
@endif

@if($order->status == 'Processed')
<form action="{{route('success_order',$order->id)}}" method="POST">
    @csrf
    <button class="btn btn-success" type="submit">Barang Siap Dikirim</button>
</form>
@endif
@section('footer')
<script>
    $(document).ready(function() {
        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            // var price = $el.find(".product_price").val();
            var quantity = $el.find(".itemQty").val();
            let html = ""
            var url = "{{url('bidding-price/')}}";
            var convert = quantity.replace(/[^\w\s]/gi, '')
            $.ajax({
                url: url,
                method: 'post',
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    total_price: Number(convert),

                    id: pid
                },
                success: function(response) {
                    let = sub_total = 0
                    console.log(response, 'sub')
                    sub_total = response.reduce((prev, curr) => Number(prev) + Number(curr.total_price), 0)
                    html += ` <td style="color: black;">${Intl.NumberFormat('id-ID',{style:"currency",currency:"IDR"}).format(sub_total)}</td>`

                    $('#sub_total').html(html);
                }
            })
        })
    })
</script>
@endsection
@endsection