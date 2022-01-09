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
<table class="table">
    <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga Di Tawarkan (Rp)</th>

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
                    <option value="Pack">Pack</option>
                    <option value="Unit">Unit</option>
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
@if($order && $order->status == 'Bidding')
<div class="row">
    <form action="{{route('request_bidding_price',$order->id)}}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">Ajukan Penawaran</button>
    </form>
    <!-- <form action="{{route('bidding_deal_company',$order->id)}}" method="POST">
        @csrf
        <button class="btn btn-success" type="submit">Setuju</button>
    </form> -->
</div>
@else
@endif
@if($order->status == 'Processed')
<input type="text" name="address" class="form-control" value="{{$detail->address}}" placeholder="Alamat Pengiriman" />
</br>
<div class="justify-content-center">
    <button class="btn btn-success">Terima Kasih telah memilih kami, Penawaran telah di setujui</button>
</div>
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