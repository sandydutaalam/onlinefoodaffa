<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>All Orders</title>
    <link href="{{ asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body class="fix-header fix-sidebar">

    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
   <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->

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

                <div class="row">
                    <div class="col-12">


                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="text-white m-b-0">All Orders</h4>
                                </div>

                                <div class="card-body">
                                    <h4 class="card-title">Generate Reports</h4>
                                    <form action="{{ route('userorders.monthlyReport') }}" method="GET"
                                        target="_blank" class="form-inline">
                                        <div class="mb-2 mr-3 form-group">
                                            <label for="month" class="mr-2">Select Month:</label>
                                            <select name="month" id="month" class="form-control" required>
                                                @for ($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}">
                                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="mb-2 mr-3 form-group">
                                            <label for="year" class="mr-2">Select Year:</label>
                                            <select name="year" id="year" class="form-control" required>
                                                @for ($y = 2020; $y <= date('Y'); $y++)
                                                    <option value="{{ $y }}">{{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <button type="submit" class="mb-2 btn btn-primary">Generate
                                            Report</button>
                                    </form>

                                </div>
                                {{-- GENERATE PDF --}}


                                <div class="table-responsive m-t-30">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nama Menu</th>
                                                <th>Catatan</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Nomor Meja</th>
                                                <th>Status</th>
                                                <th>Update Order Time</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->title }}</td>
                                                    <td>{{ $order->note }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>Rp. {{ number_format($order->price, 3, ',', '.') }}</td>
                                                    <td>{{ $order->table_number }}</td>
                                                    <!-- <td> <button type="button" class="btn btn-info"><span
                                                                class="fa fa-bars" aria-hidden="true"></span>
                                                            Dispatch</button> -->
                                                        <!-- <td> 
                                                            
                                                   <select id="dispacth" name="dispacth" class="form-control" required>
                                                        <option value=""> Ready</option>
                                                        <option value="bca">On Progress</option>
                                                        
                                                        
                                                    </select>
                                                    </td> -->

                                                    <td>
                                                    <form action="{{ route('admin.all_orders.update', ['o_id' => $order->o_id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="input-group">
                                                            <select name="status" class="form-select">
                                                                <option value="on_the_way" {{ $order->status == 'on_the_way' ? 'selected' : '' }}>On the Way</option>
                                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-info">Update</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                

                                                    <td>{{ $order->date }}</td>
                                                    <td>
                                                        <!-- <form action="delete" method="delete"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                                <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                            </button>
                                                        </form> -->
                                                        <form action="{{ route('admin.all_orders.delete', ['o_id' => $order->o_id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus order ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                    </button>
                                                        </form>

                                                        <a href="{{ route('admin.all_orders.view', ['o_id' => $order->o_id]) }}"
                                                            class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <center>No Menu</center>
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
            </div>





        </div>
    </div>

    </div>


    <footer class="footer"> © 2024 - Restaurant Ordering System</footer>

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
