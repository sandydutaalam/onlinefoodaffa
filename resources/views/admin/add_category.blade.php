<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Category</title>
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
            <div class="container-fluid">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
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

                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Restaurant Category</h4>
                        </div>
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <input type="text" name="c_name" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="" class="btn btn-inverse">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Listed Categories</h4>
                            <div class="table-responsive m-t-40">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->c_id }}</td>
                                            <td>{{ $category->c_name }}</td>
                                            <td>{{ $category->date }}</td>
                                            <td>
                                                <form action="{{ route('admin.categories.delete', ['c_id' => $category->c_id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus restoran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.categories.edit', ['c_id' => $category->c_id]) }}" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if ($categories->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">No Categories-Data!</td>
                                        </tr>
                                        @endif
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