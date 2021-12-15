@extends('general_template')
@section('content')
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">


            <div class="row col-lg">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{$data->getImage()}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 id="titleProd">{{$data->name}}</h3>
                    <h2>{{$data->rupiah()}}</h2>

                    <p>Availibility {{$data->stock}}: In Stock</p>
                    <p>Berat {{$data->weight}} Gram</p>
                    <!-- <div id="desc">
                        <p>{{$data->description}}</p>
                    </div> -->
                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                        <a class="button primary-btn" href="#">Add to Cart</a>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                        <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{$data->description}}</p>
                </div>

            </div>
        </div>
    </section>
    @endsection