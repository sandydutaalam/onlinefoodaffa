<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>All Restaurants</title>
    <link href="{{ asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="fix-header fix-sidebar">

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

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">All Restaurants</h4>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Url</th>
                                            <th>Open Hrs</th>
                                            <th>Close Hrs</th>
                                            <th>Open Days</th>
                                            <th>Address</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($restaurants as $restaurant)
                                        <tr>
                                            <td>{{ $restaurant->category->c_name ?? 'No Category' }}</td>
                                            <td>{{ $restaurant->title }}</td>
                                            <td>{{ $restaurant->email }}</td>
                                            <td>{{ $restaurant->phone }}</td>
                                            <td>{{ $restaurant->url }}</td>
                                            <td>{{ $restaurant->o_hr }}</td>
                                            <td>{{ $restaurant->c_hr }}</td>
                                            <td>{{ $restaurant->o_days }}</td>
                                            <td>{{ $restaurant->address }}</td>
                                            <td>
                                                <center>
                                                    <img src="{{ asset('Res_img/' . $restaurant->image) }}" class="img-responsive radius" style="min-width:150px;min-height:100px;" />
                                                </center>
                                            </td>
                                            <td>{{ $restaurant->date }}</td>
                                            <td>
                                                <form action="{{ route('admin.all_restaurant.delete', ['rs_id' => $restaurant->rs_id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus restoran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.all_restaurant.edit', ['rs_id' => $restaurant->rs_id]) }}" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="12">
                                                <center>No Restaurants</center>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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