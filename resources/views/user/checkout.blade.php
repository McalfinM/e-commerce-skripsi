@extends('general_template')
@section('content')
<!--================Checkout Area =================-->
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

<section class="checkout_area section-margin--small">
    <div class="container">

        <div class="billing_details">
            <form action="{{route('create_payment',$order->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Detail Pembayaran</h3>

                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="name" value="{{old('name')}}" placeholder="Nama anda">
                            <span class="placeholder" data-placeholder="First name"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="phone_number" value="{{old('phone_number')}}" placeholder="Nomor Handphone">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                        </div>

                        <div class="col-md-6 form-group ">

                            <select id="province" name="province" class="form-control">
                                <option value="">Provinsi</option>
                                @foreach ($province as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 form-group">

                            <select name="city" id="cities" class="form-control">
                                <option>Kota</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">

                            <select name="district" id="districts" class="form-control">
                                <option>Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="village" name="village" placeholder="Kelurahan">
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{old('postal_code')}}" placeholder="Kode pos">
                        </div>


                        </br>


                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="email" name="address" value="{{old('address')}}" placeholder="Alamat Lengkap">
                            <span class="placeholder" data-placeholder="Email Address"></span>
                        </div>
                        <!-- <div class="col-lg" id="model_pengiriman">
                            <div class="row">

                                <div class="col-md-3">

                                    <label>Model Pengiriman JNE</label>
                                    <select name="result_ongkir" id="result_ongkir" class="form-control">

                                    </select>
                                </div>
                                <div class="col-md-2" id="result_ongkir_value">

                                </div>
                                <div class="col-md" id="etd">

                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">
                                        <h4>Product <span>Total</span></h4>
                                    </a></li>
                                @php
                                $sub_total = 0;
                                $total_weight = 0;
                                @endphp
                                @foreach($order->OrderDetail as $detail)
                                @php
                                $sub_total += $detail->total_price;
                                $total_weight += $detail->product->weight;
                                @endphp
                                <li><a href="#">{{Str::limit($detail->product->name,10)}} <span class="middle">x{{$detail->quantity}}</span> <span class="last">{{$detail->product->rupiah()}}</span></a></li>
                                @endforeach
                            </ul>
                            <ul class="list list_2">
                                <!-- <li><a href="#">Subtotal <span>{{"Rp " . number_format($sub_total, 2, ',', '.')}}</span></a></li>
                            <div id="shipping">

                            </div> -->

                                <div id="total_price_div">
                                    <li><a href="#">Total <span>{{"Rp " . number_format($sub_total, 2, ',', '.')}}</span></a></li>
                                    <input id="total_price" type="hidden" name="total_price" value="{{$sub_total}}" />
                                </div>
                            </ul>

                            <!-- <label style="color: black;" for="weight">Berat/Gram</label> -->
                            <!-- <input type="number" name="weight" id="weight" value="{{$total_weight}}" /> -->


                            <div class="payment_item active">

                                <label for="f-option6">Bukti Transfer</label>
                                <input type="hidden" value="Bukti Transfer" name="payment_method" />
                                <input type="file" name="image" id="image">

                            </div>
                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="http://lpm.unidayan.ac.id/asset/img/artikel/default.jpg" alt="preview image" style="max-height: 150px;">
                            </div>


                        </div>

                        <div class="text-center">
                            <button class="button button-paypal" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>


@section('footer')
<!-- <script type="text/javascript">
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
                            $('#city_destinasi').append('<option value="' + value.city_id + '">' + value.type + ' ' + value.city_name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_destinasi').empty();
            }
        });
    });
</script> -->

<!-- <script type="text/javascript">
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
                        $('#result_ongkir').append('<option value="">' + 'Model Pengiriman' + '</option>');
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
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#province').on('change', function() {
            var provID = $(this).val();
            if (provID) {
                $.ajax({
                    url: '/cities/' + provID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#cities').empty();
                        $('#cities').append('<option value="">' + "Pilih Kota" + '</option>');
                        $.each(data.cities, function(key, value) {

                            $('#cities').append('<option value="' + value.id + '">' + value.nama_kota + '</option>');
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
        $('#cities').on('change', function() {
            var cityId = $(this).val();

            if (cityId) {
                $.ajax({
                    url: '/districts/' + cityId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#districts').empty();
                        $.each(data.districts, function(key, value) {
                            $('#districts').append('<option value="' + value.id + '">' + value.nama_kecamatan + '</option>');
                        });
                    }
                });
            } else {
                $('#districts').empty();
            }
        });
    });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#result_ongkir').on('change', function() {
            var provID = $(this).val();

            let destination = $("#city_destinasi").val();
            let weight = $("#weight").val();
            let result_ongkir = $("#result_ongkir").val();
            let total_price = $("#total_price").val()

            let html = "";
            let html_two = ""
            let shipping_html = ""
            let total_price_html = ""

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
                        $('#total_price_div').empty();
                        let diskon = 0;
                        let total_diskon = 0
                        let price_total = 0
                        // let value_diskon = 0;
                        $.each(data.rajaongkir.results[0].costs[result_ongkir].cost, function(key, value) {

                            if (weight > 5000) {
                                diskon = 20 / 100 * value.value;
                                total_diskon = Number(value.value) - Number(diskon)
                                price_total = Number(total_diskon) + Number(total_price)
                            } else {
                                price_total = value.value
                                total_diskon = price_total
                            }
                            html += `
                             <label for="etd">Harga</label>
                            <input type="text" class="form-control" readonly name="shipping_value" value=${Number(total_diskon) } />`

                            $('#result_ongkir_value').html(html);
                            html_two += `
                            <label for="etd">Estimasi Perkiraan Tiba (hari)</label>
                            <input type="text" class="form-control" readonly name="etd" value="${value.etd}" />`
                            shipping_html += `
                        
                            <li><a href="#">Shipping <span>${Intl.NumberFormat('id-ID',{style:"currency",currency:"IDR"}).format(total_diskon)}</span></a></li>`
                            total_price_html += ` <li><a href="#">Total <span>${Intl.NumberFormat('id-ID',{style:"currency",currency:"IDR"}).format(price_total)}</span></a></li>
                                <input id="total_price" type="hidden" value="${Number(price_total)}" />`

                            $('#shipping').html(shipping_html);
                            $('#total_price_div').html(total_price_html);
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
<script>
    document.getElementById("model_pengiriman").style.display = "none";
    $(document).ready(function() {
        $('#city_destinasi').on('change', function() {
            var provID = $(this).val();
            let html = "";
            let total_price_html = ""
            let total_price = $("#total_price").val()
            let shipping_html = ""
            let etd_html = ""
            if (provID !== "78") {
                document.getElementById("model_pengiriman").style.display = "block";
                shipping_html += ` <input type="text" class="form-control" readonly name="shipping_value" value="0" />`
                etd_html += `
                            <label for="etd">Estimasi Perkiraan Tiba (hari)</label>
                            <input type="text" class="form-control" readonly name="etd" value="" />`
                $('#etd').html(etd_html);
                $('#shipping').html(shipping_html);

            } else {
                document.getElementById("model_pengiriman").style.display = "none";
                html += `
                        
                            <li><a href="#">Shipping <span>0</span></a></li>`


                total_price_html += ` <li><a href="#">Total <span>{{"Rp " . number_format($sub_total, 2, ',', '.')}}</a></li>
                                <input id="total_price" type="hidden" value="{{$sub_total}}" />`

                $('#shipping').html(html);
                $('#total_price_div').html(total_price_html);

            }
        })
    })
</script> -->
@endsection

@endsection