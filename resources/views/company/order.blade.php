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
            <th scope="col">Action</th>
            <th scope="col">Satuan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $sub_total = 0;
        $total_weight = 0;
        @endphp
        @if($orderDetail!== null)
        @foreach($orderDetail as $detail)
        @php
        $sub_total += $detail->total_price;
        $total_weight += $detail->product->weight;
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
                    <input style="width: 70px;" type="number" min="1" name="quantity" id="sst" maxlength="12" value="{{$detail->quantity}}" title="Quantity:" class="itemQty form-control">

                </div>
            </td>
            <td>
                <select name="volume" class="volume form-control">
                    <option>{{$detail->volume ?? 'Satuan'}}</option>
                    <option value="Pack">Pack</option>
                    <option value="Unit">Unit</option>
                </select>
            </td>
            <td>
                <a class="btn btn-danger" href="{{route('delete_item',$detail['id'])}}"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif


    </tbody>
</table>
@if($order)
<a href="{{route('company_request_price_order',$order->id)}}" class="btn btn-primary">Kirim List Barang</a>
@endif
@section('footer')
<script>
    $(document).ready(function() {
        $(".itemQty").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            // var price = $el.find(".product_price").val();
            var quantity = $el.find(".itemQty").val();
            var url = "{{url('company/cart-update/')}}";
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
                    console.log(data, 'ini data')
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function() {
        $(".volume").on('change', function() {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            // var price = $el.find(".product_price").val();
            var quantity = $el.find(".volume").val();
            var url = "{{url('company/order/volume-update/')}}";
            $.ajax({
                url: url,
                method: 'post',
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    volume: quantity,
                    id: pid
                },
                success: function(response) {
                    console.log(data, 'ini data')
                }
            })
        })
    })
</script>
@endsection
@endsection