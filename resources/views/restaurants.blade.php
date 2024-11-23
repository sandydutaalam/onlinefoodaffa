<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header-scroll top-header headrom">
        <style>
            .navbar-brand img {
                max-width: 75px;
                height: auto;
                width: auto;
                padding: 0px;
            }
        </style>
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/lo.png" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('restaurants') }}">Restaurants <span class="sr-only"></span></a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <div class="inner-page-hero bg-image" data-image-src="{{ asset('images/other_img/pimg.jpg') }}">
            <div class="container"> </div>
        </div>

        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <div class="container">
                                    <div class="row">
                                        <div class="container">
                                            <div class="row">
                                                @foreach($restaurants as $restaurant)
                                                @php
                                                $restaurantImageUrl = asset('Res_img/' . $restaurant->image);
                                                @endphp

                                                <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                                    <div class="entry-logo">
                                                        <a class="img-fluid" href="{{ url('dishes', ['res_id' => $restaurant->rs_id]) }}">
                                                            <img src="{{ $restaurantImageUrl }}" alt="Food logo">
                                                        </a>
                                                    </div>
                                                    <!-- end:Logo -->
                                                    <div class="entry-dscr">
                                                        <h5><a href="{{ url('dishes', ['res_id' => $restaurant->rs_id]) }}">{{ $restaurant->title }}</a></h5>
                                                        <span>{{ $restaurant->address }}</span>
                                                    </div>
                                                    <!-- end:Entry description -->
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                                    <div class="right-content bg-white">
                                                        <div class="right-review">
                                                            <a href="{{ url('dishes', ['res_id' => $restaurant->rs_id]) }}" class="btn btn-purple">View Menu</a>
                                                        </div>
                                                    </div>
                                                    <!-- end:right info -->
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



                    </div>



                </div>
            </div>
    </div>
    </section>

    <footer class="footer">
        <div class="container">


            <div class="bottom-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 payment-options color-gray">
                        <h5>Payment Options</h5>
                        <ul>
                            <li>
                                <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                            </li>
                            <li>
                                <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 address color-gray">
                        <h5>Address</h5>
                        <p>23 Pasir Kaliki Mall, Bandung</p>
                        <h5>Phone: (022) 1234567</a></h5>
                    </div>
                    <div class="col-xs-12 col-sm-5 additional-info color-gray">
                        <h5>Addition informations</h5>
                        <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>