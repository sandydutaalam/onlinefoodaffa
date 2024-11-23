<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Add Restaurant</title>
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
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Restaurant</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form Start -->
                            <form action="{{ route('admin.restaurants.save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Restaurant Name</label>
                                                <input type="text" name="res_name" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Business E-mail</label>
                                                <input type="email" name="email" class="form-control form-control-danger" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Website URL</label>
                                                <input type="url" name="url" class="form-control form-control-danger">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Hours</label>
                                                <select name="o_hr" class="form-control custom-select" required>
                                                    <option value="" disabled selected>--Select your Hours--</option>
                                                    <option value="6am">6am</option>
                                                    <option value="7am">7am</option>
                                                    <option value="8am">8am</option>
                                                    <option value="9am">9am</option>
                                                    <option value="10am">10am</option>
                                                    <option value="11am">11am</option>
                                                    <option value="12pm">12pm</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Close Hours</label>
                                                <select name="c_hr" class="form-control custom-select" required>
                                                    <option value="" disabled selected>--Select your Hours--</option>
                                                    <option value="3pm">3pm</option>
                                                    <option value="4pm">4pm</option>
                                                    <option value="5pm">5pm</option>
                                                    <option value="6pm">6pm</option>
                                                    <option value="7pm">7pm</option>
                                                    <option value="8pm">8pm</option>
                                                    <option value="9pm">9pm</option>
                                                    <option value="10pm">10pm</option>
                                                    <option value="11pm">11pm</option>
                                                    <option value="12am">12am</option>
                                                    <option value="1am">1am</option>
                                                    <option value="2am">2am</option>
                                                    <option value="3am">3am</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Days</label>
                                                <select name="o_days" class="form-control custom-select" required>
                                                    <option value="" disabled selected>--Select your Days--</option>
                                                    <option value="Mon-Tue">Mon-Tue</option>
                                                    <option value="Mon-Wed">Mon-Wed</option>
                                                    <option value="Mon-Thu">Mon-Thu</option>
                                                    <option value="Mon-Fri">Mon-Fri</option>
                                                    <option value="Mon-Sat">Mon-Sat</option>
                                                    <option value="24hr-x7">24hr-x7</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" class="form-control form-control-danger">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Category</label>
                                                <select name="c_name" class="form-control custom-select" required>
                                                    <option value="" disabled selected>--Select Category--</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->c_id }}">{{ $category->c_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="box-title m-t-40">Restaurant Address</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="address" class="form-control" style="height:100px;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{ route('admin.all_restaurant') }}" class="btn btn-inverse">Cancel</a>
                                </div>
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
                <footer class="footer"> © 2024 - Restaurant Ordering System </footer>
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