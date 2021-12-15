<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manyar Sewu</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/nice-select/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/owl-carousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/general/assets/vendors/owl-carousel/owl.carousel.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/general/assets/css/style.css')}}">


</head>
<style>
    #desc {
        max-width: 300px;
        word-wrap: break-word;
    }

    #titleProd {
        max-width: 400px;
        word-wrap: break-word;
    }
</style>

<body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand logo_h" href="/"><img width="100" src="{{asset('image/main/logo.jpeg')}}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">

                            <form>
                                <div class="card-body row no-gutters align-items-center">

                                    <!--end of col-->
                                    <div class="col-lg">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Cari disini">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </ul>

                        <ul class="nav-shop">
                            <li class="nav-item"><button><i class="ti-search"></i></button></li>

                            @if(Auth::user())
                            <li class="nav-item"><a href="{{route('cart')}}"><i class="ti-shopping-cart"></i><span class="nav-shop__circle">{{auth()->user()->order()->quantity ?? 0}}</span></a> </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->username}}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="login.html">Daftar Pesanan</a></li>
                                    <li class="nav-item"><a class="nav-link" href="register.html">Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item"><a href="{{route('cart')}}"><i class="ti-shopping-cart"></i><span class="nav-shop__circle">0</span></a> </li>
                            <li class="nav-item"><a class="button button-header" href="{{route('login')}}">Login/Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->


    <!--================ Hero banner start =================-->
    <div class="container">
        @yield('content')
    </div>

    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->



    <!--================ Start footer Area  =================-->
    <footer class="footer">
        <div class="footer-area">
            <div class="container">
                <div class="row section_gap">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title large_title">Manyar Sewu</h4>

                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Quick Links</h4>
                            <ul class="list">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Shop</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">Brand</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h4 class="footer_title">Gallery</h4>
                            <ul class="list instafeed d-flex flex-wrap">
                                <li><img src="img/gallery/r1.jpg" alt=""></li>
                                <li><img src="img/gallery/r2.jpg" alt=""></li>
                                <li><img src="img/gallery/r3.jpg" alt=""></li>
                                <li><img src="img/gallery/r5.jpg" alt=""></li>
                                <li><img src="img/gallery/r7.jpg" alt=""></li>
                                <li><img src="img/gallery/r8.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Contact Us</h4>
                            <div class="ml-40">
                                <p class="sm-head">
                                    <span class="fa fa-location-arrow"></span>
                                    Head Office
                                </p>
                                <p>123, Main Street, Your City</p>

                                <p class="sm-head">
                                    <span class="fa fa-phone"></span>
                                    Phone Number
                                </p>
                                <p>
                                    +123 456 7890 <br>
                                    +123 456 7890
                                </p>

                                <p class="sm-head">
                                    <span class="fa fa-envelope"></span>
                                    Email
                                </p>
                                <p>
                                    free@infoexample.com <br>
                                    www.infoexample.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row d-flex">
                    <p class="col-lg-12 footer-text text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->



    <script src="{{asset('assets/general/assets/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/skrollr.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('assets/general/assets/vendors/mail-script.js')}}"></script>
    <script src="{{asset('assets/general/assets/js/main.js')}}"></script>
    @yield('footer')
    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#image').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>

</body>

</html>