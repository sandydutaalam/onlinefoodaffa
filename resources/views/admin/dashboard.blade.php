<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="{{ asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="fix-header">
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('admin/dashboard') }}">
                        <span><img src="{{ asset('images/icn.png') }}" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="mr-auto navbar-nav mt-md-0">
                    </ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown">
                            <img src="{{ asset('images/bookingSystem/user-icn.png') }}" alt="user"
                                class="profile-pic" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="dropdown-user">
                                <li><a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fa fa-power-off"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                            </ul>
                        </div>
                    </li>
                </div>
            </nav>
        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @if (session('role') == 'admin')
                            <li class="nav-devider"></li>
                            <li class="nav-label">Home</li>
                            <li>
                                <a href="{{ url('admin/dashboard') }}">
                                    <i class="fa fa-tachometer"></i><span>Dashboard</span>
                                </a>
                            </li>
                        @endif


                        <li class="nav-label">Log</li>
                        @if (session('role') == 'admin')
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <i class="fa fa-archive f-s-20 color-warning"></i><span
                                        class="hide-menu">Restaurant</span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ url('admin/all_restaurant') }}">All Restaurant</a></li>
                                    <li><a href="{{ route('admin.categories.create') }}">Add Category</a></li>
                                    <li><a href="{{ route('admin.restaurants.create') }}">Add Restaurant</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="#" aria-expanded="false">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ url('admin/all_menu') }}">All Menu</a></li>
                                    <li><a href="{{ route('admin.menues.create') }}">Add Menu</a></li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('admin/order') }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="text-white m-b-0">Admin Dashboard
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-home f-s-40"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $restaurantsCount }}</h2>
                                            <p class="m-b-0">Restaurants</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $dishesCount }}</h2>
                                            <p class="m-b-0">Dishes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $ordersCount }}</h2>
                                            <p class="m-b-0">Total Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $categoryCount }}</h2>
                                            <p class="m-b-0">Restro Categories</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $processingOrders }}</h2>
                                            <p class="m-b-0">Processing Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $deliveredOrders }}</h2>
                                            <p class="m-b-0">Delivered Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $cancelledOrders }}</h2>
                                            <p class="m-b-0">Cancelled Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <h2>{{ $totalEarnings }}</h2>
                                            <p class="m-b-0">Total Earnings</p>
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

    <script src="{{ asset('js/admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/lib/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('js/admin/lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/admin/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/admin/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('js/admin/custom.min.js') }}"></script>
</body>

</html>
