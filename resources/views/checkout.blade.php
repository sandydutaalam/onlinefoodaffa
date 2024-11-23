<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="site-wrapper">
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
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/lo.png"
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

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose
                                Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite
                                food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and
                                Pay</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">

                <span style="color:green;">

                </span>

            </div>




            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="clearfix widget">

                        <div class="widget-body">
                            <form method="post" action="#">

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Cart Summary</h4>
                                            </div>
                                            <div class="cart-totals-fields">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($cartItems as $item)
                                                            <tr>
                                                                <td>{{ $item['title'] }}

                                                                </td>
                                                                <td>
                                                                    Note : {{ $item['note'] ?? '' }}
                                                                </td>
                                                                <td>{{ $item['quantity'] }}</td>
                                                                <td>Rp.{{ number_format($item['price'], 3) }}</td>
                                                                <td>Rp.{{ number_format($item['price'] * $item['quantity'], 3) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td colspan="3">Rp.{{ number_format($itemTotal, 3) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Resto Charges 10%</td>
                                                            <td colspan="3">
                                                                Rp.{{ number_format($restaurantCharge, 3) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total</strong></td>
                                                            <td colspan="3">
                                                                <strong>Rp.{{ number_format($total, 3) }}</strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <form action="{{ route('checkout.process') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="table_number">Nomor Meja</label>
                                                        <input type="text" class="form-control" name="table_number"
                                                            id="table_number" required>
                                                    </div>


                                                </form>

                                                @if (session('success'))
                                                    <div class="mt-3 alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @elseif(session('error'))
                                                    <div class="mt-3 alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="payment-option">
                                            <ul class=" list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD"
                                                            type="radio" class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">Bayar di Kasir</span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <p class="text-xs-center"> <input type="submit"
                                                    onclick="return confirm('Do you want to confirm the order?');"
                                                    name="submit" class="btn btn-success btn-block" value="Order Now">
                                            </p>
                                        </div>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
        </form>
    </div>

    <footer class="footer">
        <div class="row bottom-footer">
            <div class="container">
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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
