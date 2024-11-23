<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Dishes</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>

    </style>

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
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                    data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="{{ asset('images/lo.png') }}"
                        alt=""> </a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span
                                    class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span
                                    class="sr-only"></span></a> </li>


                    </ul>

                </div>
            </div>
        </nav>

    </header>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="{{ route('restaurants') }}">Choose
                            Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item active">
                        <span>2</span>
                        <a href="{{ route('dishes.show', ['res_id' => $restaurant->rs_id]) }}">Pick Your favorite
                            food</a>
                    </li>

                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>

                </ul>
            </div>
        </div>
        <section class="inner-page-hero bg-image" data-image-src="{{ asset('images/other_img/restrrr.png') }}">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure>
                                    <img src="{{ asset('Res_img/' . $restaurant->image) }}" alt="Restaurant logo">
                                </figure>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#">{{ $restaurant->title }}</a></h6>
                                <p>{{ $restaurant->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="breadcrumb">
            <div class="container">
                <!-- Breadcrumb content jika diperlukan -->
            </div>
        </div>

        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">Your Cart</h3>
                        </div>
                        <div class="bg-white order-row">
                            <div class="widget-body">
                                @php
                                    $item_total = 0;
                                @endphp

                                @if (session('cart_item'))
                                    @foreach (session('cart_item') as $item)
                                        <div class="title-row">
                                            {{ $item['title'] }}
                                            <a
                                                href="{{ route('dishes.remove', ['res_id' => $restaurant->rs_id]) }}?action=remove&id={{ $item['d_id'] }}">
                                                <i class="fa fa-trash pull-right"></i>
                                            </a>
                                        </div>
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control b-r-0"
                                                    value="Rp.{{ $item['price'] }}" readonly>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" readonly
                                                    value="{{ $item['quantity'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control b-r-0"
                                                value="{{ $item['note'] ?? '' }}" readonly>
                                        </div>
                                        @php
                                            $item_total += $item['price'] * $item['quantity'];
                                        @endphp
                                        <div class="clearfix"></div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong>Rp.{{ number_format($item_total, 3, '.') }}</strong></h3>
                                <p>plus PPN 10%!</p>
                                <a href="{{ route('checkout.show') }}"
                                    class="btn {{ $item_total == 0 ? 'btn-danger disabled' : 'btn-success' }} btn-lg">
                                    Checkout
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2"
                                    aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            @foreach ($dishes as $dish)
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <form method="post"
                                                action="{{ route('dishes.add', ['res_id' => $restaurant->rs_id]) }}?id={{ $dish->d_id }}">
                                                @csrf
                                                <div class="rest-logo pull-left">
                                                    <a class="restaurant-logo pull-left" href="#">
                                                        <img src="{{ asset('Res_img/dishes/' . $dish->img) }}"
                                                            alt="Food logo">
                                                    </a>
                                                </div>
                                                <div class="rest-descr">
                                                    <h6><a href="#">{{ $dish->title }}</a></h6>
                                                    <p>{{ $dish->slogan }}</p>
                                                </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                            <span class="price pull-left">Rp.{{ $dish->price }}</span>
                                            <input class="form-control form-control-sm" type="text"
                                                name="quantity" value="1" size="2" />
                                            <input type="text" name="note" placeholder="Add note"
                                                class="form-control form-control-sm" />

                                            <input type="submit" class="mt-1 btn theme-btn" value="Add To Cart" />
                                            </form>
                                        </div>
                                    </div>
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

    <footer class="footer">
        <div class="container">

            <div class="row bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="{{ asset('images/paypal.png') }}" alt="Paypal">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{ asset('images/mastercard.png') }}"
                                            alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{ asset('images/maestro.png') }}" alt="Maestro">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{ asset('images/stripe.png') }}" alt="Stripe">
                                    </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="{{ asset('images/bitcoin.png') }}" alt="Bitcoin">
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Jl. Pulo Asem Utara Raya No.59, RT.15/RW.2, Jati, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13220</p>
                            <h5>Phone: 0815-8517-9888</a></h5>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    </div>

    </div>


    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img
                                            src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>

                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>

                            </div>

                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$
                                    2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0"
                                            id="quant-input-2">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img
                                            src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>

                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>

                            </div>

                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$
                                    2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0"
                                            id="quant-input-3">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img
                                            src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>

                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>

                            </div>

                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$
                                    1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0"
                                            id="quant-input-4">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img
                                            src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>

                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6>
                                </div>

                            </div>

                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$
                                    3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0"
                                            id="quant-input-5">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animsition.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('js/headroom.js') }}"></script>
    <script src="{{ asset('js/foodpicky.min.js') }}"></script>

</body>

</html>
