<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Update Menu</title>
    <link href="{{ asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('admin/dashboard') }}">
                        <span><img src="{{ asset('images/icn.png') }}" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown">
                            <img src="{{ asset('images/bookingSystem/user-icn.png') }}" alt="user" class="profile-pic" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="dropdown-user">
                                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a></li>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li>
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fa fa-tachometer"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-label">Log</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('admin/all_restaurant') }}">All Restaurant</a></li>
                                <li><a href="{{ route('admin.categories.create') }}">Add Category</a></li>
                                <li><a href="{{ route('admin.restaurants.create') }}">Add Restaurant</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('admin/all_menu') }}">All Menu</a></li>
                                <li><a href="{{ route('admin.menues.create') }}">Add Menu</a></li>


                            </ul>
                        </li>
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
                            <h4 class="m-b-0 text-white">Update Menu for Restaurant</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.all_menu.update', $dishes->d_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Method spoofing for PUT request -->
                                <div class="form-body">
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Dish Name</label>
                                                <input type="text" name="d_name" value="{{ old('d_name', $dishes->title) }}" class="form-control" placeholder="Morzirella" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">About</label>
                                                <input type="text" name="about" value="{{ old('slogan', $dishes->slogan) }}" class="form-control form-control-danger" placeholder="slogan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Price </label>
                                                <input type="text" name="price" value="{{ old('price', $dishes->price) }}" class="form-control" placeholder="$" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" class="form-control form-control-danger">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Restaurant</label>
                                                <select name="res_name" class="form-control custom-select" required>
                                                    <option value="">--Select Restaurant--</option>
                                                    @foreach ($restaurants as $restaurant)
                                                    <option value="{{ $restaurant->rs_id }}" {{ $dishes->rs_id == $restaurant->rs_id ? 'selected' : '' }}>{{ $restaurant->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" class="btn btn-primary" value="Save">
                                    <a href="{{ route('admin.all_menu') }}" class="btn btn-inverse">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <footer class="footer">© 2024 - Restaurant Ordering System</footer>
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