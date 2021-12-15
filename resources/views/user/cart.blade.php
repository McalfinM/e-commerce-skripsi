@extends('general_template')
@section('content')
<!--================Cart Area =================-->

@if($orderDetail)
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sub_total = 0;
                    $total_weight = 0;
                    @endphp
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
                            <h5>{{$detail->product->rupiah()}}</h5>
                        </td>
                        <td>
                            <div class="product_count">
                                <input type="number" min="1" name="quantity" id="sst" maxlength="12" value="{{$detail->quantity}}" title="Quantity:" class="input-text qty">
                                <button type="button"><i class="lnr lnr-chevron-up"></i></button>
                                <button class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                            </div>
                        </td>
                        <td>
                            <h5>{{$detail->rupiah()}}</h5>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Sub Total</td>
                        <td style="color: black;">{{"Rp " . number_format($sub_total, 2, ',', '.');}}</td>
                    </tr>



                </tbody>
            </table>



        </div>
        </hr>
        <h5>Metode Pengiriman</h5>
        <!-- <h5>Pilih Kota Asal Pengiriman</h5> -->
        <form action="{{route('check_cost')}}" method="POST">
            @csrf
            <!-- <div class="row justify-content-center">
                <div class="col-lg-6">
                    <select id="provinsi_ongkir" name="province" class="form-control">
                        <option value="">Provinsi</option>
                        @foreach ($result->rajaongkir->results as $province)
                        <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6">

                    <select name="cities" id="cities" class="form-control">
                        <option>Kota</option>
                    </select>
                </div>
            </div> -->
            </hr>
            </br>
            <h5>Pilih Kota Tujuan Pengiriman</h5>
            </hr>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <select id="provinsi_destinasi" name="province" class="form-control">
                        <option value="">Provinsi</option>
                        @foreach ($result->rajaongkir->results as $province)
                        <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4">

                    <select name="destinasi" id="city_destinasi" class="form-control">
                        <option>Kota</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <!-- <label style="color: black;" for="weight">Berat/Gram</label> -->
                    <input type="number" name="weight" id="weight" class="form-control" value="{{$total_weight}}" placeholder="Berat(gram)" />

                </div>
                </br>



            </div>
            </hr>
            </br>
            <div class="row">
                <div class="col-lg-6">
                    <label>Model Pengiriman JNE</label>
                    <select name="result_ongkir" id="result_ongkir" class="form-control">
                        <option>Model Pengiriman JNE</option>
                    </select>
                </div>
                <div class="col-lg-3" id="result_ongkir_value">

                </div>
                <div class="col-lg-3" id="etd">

                </div>
            </div>
            </br>
            <div style="float: right;">
                <div class="checkout_btn_inner d-flex align-items-center">
                    <a class="btn btn-secondary" href="/">Continue Shopping</a>
                    <a class="btn btn-primary ml-2" href="{{route('checkout',$order->order_number)}}">Proceed to checkout</a>
                </div>
            </div>
        </form>
    </div>


</section>
@else
<section class="cart_area">
    <p>Cart kosong</p>
</section>
@endif
<!--================End Cart Area =================-->
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#provinsi_ongkir').on('change', function() {
            var provID = $(this).val();
            console.log(provID[0], 'log')
            var settings = {



            };
            if (provID) {
                $.ajax({
                    "url": "/city/province/" + provID,
                    type: "GET",
                    "timeout": 0,
                    "headers": {
                        "key": "7998937f3f7cf0b25d8e9c5b372468d3",
                        "Access-Control-Allow-Origin": "*"
                    },
                    dataType: 'json',

                    success: function(data) {

                        $('#cities').empty();
                        $.each(data.rajaongkir.results, function(key, value) {
                            $('#cities').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#cities').empty();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#provinsi_destinasi').on('change', function() {
            var provID = $(this).val();
            console.log(provID[0], 'log')
            var settings = {



            };
            if (provID) {
                $.ajax({
                    "url": "/city/province/" + provID,
                    type: "GET",
                    "timeout": 0,
                    "headers": {
                        "key": "7998937f3f7cf0b25d8e9c5b372468d3",
                        "Access-Control-Allow-Origin": "*"
                    },
                    dataType: 'json',

                    success: function(data) {

                        $('#city_destinasi').empty();
                        $.each(data.rajaongkir.results, function(key, value) {
                            $('#city_destinasi').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_destinasi').empty();
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#city_destinasi').on('change', function() {
            var provID = $(this).val();
            console.log(provID[0], 'log')

            let destination = $("#city_destinasi").val();
            let weight = $("#weight").val();
            if (provID) {
                $.ajax({
                    "url": "/cost",
                    type: "POST",
                    "timeout": 0,
                    "headers": {
                        "key": "7998937f3f7cf0b25d8e9c5b372468d3",
                        "Access-Control-Allow-Origin": "*",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    "data": {
                        "origin": "78",
                        "destination": destination,
                        "weight": weight,
                        "courier": "jne",
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',

                    success: function(data) {

                        $('#result_ongkir').empty();
                        $.each(data.rajaongkir.results[0].costs, function(key, value) {
                            $('#result_ongkir').append('<option value="' + key + '">' + value.service + '</option>');
                        })
                    }
                });
            } else {
                $('#result_ongkir').empty();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#result_ongkir').on('change', function() {
            var provID = $(this).val();

            let destination = $("#city_destinasi").val();
            let weight = $("#weight").val();
            let result_ongkir = $("#result_ongkir").val();

            let html = "";
            let html_two = ""

            if (provID) {
                $.ajax({
                    "url": "/cost",
                    type: "POST",
                    "timeout": 0,
                    "headers": {
                        "key": "7998937f3f7cf0b25d8e9c5b372468d3",
                        "Access-Control-Allow-Origin": "*",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    "data": {
                        "origin": "78",
                        "destination": destination,
                        "weight": weight,
                        "courier": "jne",
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'json',

                    success: function(data) {

                        $('#result_ongkir_value').empty();
                        $('#etd').empty();
                        $.each(data.rajaongkir.results[0].costs[result_ongkir].cost, function(key, value) {
                            html += `
                             <label for="etd">Harga</label>
                            <input type="text" class="form-control" readonly name="shipping_value" value="${value.value}" />`

                            $('#result_ongkir_value').html(html);
                            html_two += `
                            <label for="etd">Estimasi Perkiraan Tiba (hari)</label>
                            <input type="text" class="form-control" readonly name="etd" value="${value.etd}" />`

                            $('#etd').html(html_two);
                        })
                    }


                });
            } else {
                $('#result_ongkir_value').empty();
                $('#etd').empty();
            }
        });
    });
</script>
@endsection

<!--================ Start footer Area  =================-->

@endsection