@extends('admin_template')
@section('content')
<section class="section-margin calc-60px">
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
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary" style="overflow: scroll;">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        @foreach($data as $datas)
                        <div class="row">
                            <div class="col-lg">
                                <div class="row">
                                    <img src="{{$datas->getImage()}}" height="20" />
                                    <p>{{$datas->name}}</p>
                                </div>

                            </div>
                            <div class=" col-lg-2">
                                <form action="{{route('createOrUpdate_order')}}" method="POST">
                                    @csrf
                                    <button class="badge badge-primary" style="float:right;"><i class="fas fa-shopping-cart"></i></button>
                                    <input type="hidden" name="product_id" value="{{$datas->id}}" />
                                    <input type="hidden" name="notes" value="" />
                                    <input type="hidden" name="type" value="company_order" />
                                </form>
                            </div>

                        </div>
                        @endforeach

                    </div>

                    <!-- /.card-body -->
                </div>
                {{$data->links()}}
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">List Pesanan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <caption>Jika barang tidak ada silahkan masukan nama barang yang anda inginkan disini</caption>
                        <input type="text" class="form-control" placeholder="Masukan nama barang" />
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orderDetail == null)

                                @else
                                @foreach($orderDetail as $detail)
                                <tr>
                                    <td>{{$detail->product->name}}</td>
                                    <td>
                                        <input type="hidden" class="pid" value="{{$detail['id']}}" />
                                        <input style="width: 70px;" type="number" min="1" name="quantity" id="sst" maxlength="12" value="{{$detail->quantity}}" title="Quantity:" class="itemQty form-control">
                                    </td>
                                    <td>
                                        <select name="volume" class="volume form-control">
                                            <option>{{$detail->volume ?? 'Satuan'}}</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Unit">Unit</option>
                                        </select>
                                    </td>
                                    <td><a class=" badge badge-danger"><i class="fas fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>

                        @if(!$order)
                        @else
                        <a href="{{route('company_request_price_order',$order->id)}}" class="btn btn-primary">Kirim List</a>
                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
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