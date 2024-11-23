<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Category</title>
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
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Restaurant</span>
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
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Update Restaurant Category</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.categories.update', $categories->c_id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') <!-- Method spoofing for PUT request -->
                                        <div class="form-body">
                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Category</label>
                                                        <input type="text" name="c_name" value="{{ old('c_name', $categories->c_name) }}" class="form-control" placeholder="Category Name" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <input type="submit" class="btn btn-primary" value="Save">
                                                <a href="{{ route('admin.categories.create') }}" class="btn btn-inverse">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <footer class="footer">© 2024 - Restaurant Ordering System</footer>
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