@extends('general_template')
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
        <div class="row justify-content-center">
            @foreach($data as $datas)
            <div class="card text-center card-product m-3">
                <div class="card-product__img">
                    <img width="150" height="130" src="{{$datas->getImage()}}" alt="">

                </div>
                <div class="row justify-content-center">

                    <a class="btn btn-secondary" href="{{route('product_detail',$datas->slug)}}"><i class="ti-search"></i></a>
                    @if(Auth::user())
                    <form action="{{route('createOrUpdate_order')}}" method="POST">
                        @csrf
                        <button class="btn btn-primary"><i class="ti-shopping-cart"></i></button>
                        <input type="hidden" name="product_id" value="{{$datas->id}}" />
                        <input type="hidden" name="notes" value="" />
                        <input type="hidden" name="type" value="individual" />
                    </form>
                    @else
                    <a class="btn btn-primary" href="{{route('login')}}"><i class="ti-shopping-cart"></i></a>
                    @endif

                </div>
                <div class="card-body">

                    <h4 class="card-product__title"><a href="single-product.html">{{$datas->name}}</a></h4>
                    <p class=" card-product__price">{{$datas->rupiah()}}</p>
                </div>
            </div>
            @endforeach
        </div>
        {{$data->links()}}
    </div>
</section>
@endsection