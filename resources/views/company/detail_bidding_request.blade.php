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
@if($order->surat_jalan !== null)
<a href="{{route('lihat_pesanan_pelanggan', $order->id)}}" class="btn btn-primary">Lihat Daftar Pesanan</a>
@endif
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga Di Tawarkan (Rp)</th>
                <th scope="col">Harga Sebelumnya (Rp)</th>
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
                    <div class="product_count">
                        <input type="hidden" class="pid" value="{{$detail['id']}}" />
                        @if($order->status == 'Bidding')
                        <input width="70px" type="number" style="width: 200px;" name="quantity" value="{{$detail->quantity}}" class="quantity form-control" />
                        @else
                        <input style="width: 70px;" readonly name="total_price" value="{{$detail->quantity}}" class="form-control" />
                        @endif

                    </div>
                </td>
                <td>
                    @if($order->status == 'Bidding')
                    <select name="volume" class="form-control">
                        <option>{{$detail->volume}}</option>
                        @if($detail->volume === 'Pack')
                        <option value="Unit">Unit</option>
                        @elseif($detail->volume === 'Unit')
                        <option value="Pack">Pack</option>
                        @endif
                    </select>
                    @else
                    <input readonly type="text" value="{{$detail->volume}}" />
                    @endif
                </td>
                <td>
                    @if($order->status == 'Bidding')
                    <input style="width: 200px;" name="total_price" value="{{number_format($detail->total_price, 0,',', '.');}}" class="itemQty form-control" />
                    @else
                    <input style="width: 200px;" readonly name="total_price" value="{{number_format($detail->total_price, 2, ',', '.');}}" class="form-control" />
                    @endif
                </td>
                <td> <input style="width: 200px;" readonly name="total_price" value="{{number_format($detail->previous_price, 2, ',', '.');}}" class="form-control" /></td>


            </tr>

            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>Total Harga</td>
                <td id="sub_total" style="color: black;">{{"Rp " . number_format($sub_total, 2, ',', '.');}}</td>
            </tr>

            @endif


        </tbody>
    </table>
</div>
@if($order && $order->status == 'Bidding')
<div class="row">
    <form class="mr-2" action="{{route('request_bidding_price',$order->id)}}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Ajukan Penawaran</button>
        <input name="company" value="menawar" type="hidden" />
    </form>

    <!-- <form action="{{route('bidding_deal_company',$order->id)}}" method="POST">
        @csrf
        <button style="visibility: visible;" id="setuju" class="btn btn-success" type="submit">Setuju</button>
    </form> -->
</div>
@else
@endif
@if($order->status == 'Processed')
<br>
@include('company.completing_order')

@endif

@section('footer')
<script>
    $(document).ready(function() {
        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var prev = $el.find(".pid").val();

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
                    sub_total = response.reduce((prev, curr) => Number(prev) + Number(curr.total_price), 0)
                    html += ` <td style="color: black;">${Intl.NumberFormat('id-ID',{style:"currency",currency:"IDR"}).format(sub_total)}</td>`

                    $('#sub_total').html(html);
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(".quantity").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            // var price = $el.find(".product_price").val();

            var url = "{{url('company/cart-update/')}}";
            var quantity = $el.find(".quantity").val();


            $.ajax({
                url: url,
                method: 'post',
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity,
                    id: pid
                },
                success: function(response) {

                }
            })
        })
    })
</script>
@endsection
@endsection