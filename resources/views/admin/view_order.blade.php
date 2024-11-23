<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>View Order</title>
    <link href="{{ asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script language="javascript" type="text/javascript">
        var popUpWin = 0;

        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin',
                'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
                1000 + ',height=' + 1000 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top +
                '');
        }
    </script>
</head>

<body class="fix-header fix-sidebar">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                stroke-miterlimit="10" />
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

                <div class="row">
                    <div class="col-12">


                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="text-white m-b-0">View Order</h4>
                                </div>

                                <div class="table-responsive m-t-20">
                                    <table id="myTable" class="table table-bordered table-striped">

                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td><strong>Table Number:</strong></td>
                                                    <td>
                                                        <center>{{ $order->table_number }}</center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Quantity:</strong></td>
                                                    <td>
                                                        <center>{{ $order->quantity }}</center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Price:</strong></td>
                                                    <td>
                                                        <center>
                                                            Rp.{{ number_format($order->total_price, 0, ',', '.') }}
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date:</strong></td>
                                                    <td>
                                                        <center>{{ $order->date }}</center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td>
                                                        <center>
                                                            @if ($order->status == '' || $order->status == 'NULL')
                                                                <button type="button" class="btn btn-info">
                                                                    <span class="fa fa-bars"
                                                                        aria-hidden="true"></span> Dispatch
                                                                </button>
                                                            @elseif ($order->status == 'in process')
                                                                <button type="button" class="btn btn-warning">
                                                                    <span class="fa fa-cog fa-spin"
                                                                        aria-hidden="true"></span> On the Way!
                                                                </button>
                                                            @elseif ($order->status == 'closed')
                                                                <button type="button" class="btn btn-primary">
                                                                    <span class="fa fa-check-circle"
                                                                        aria-hidden="true"></span> Delivered
                                                                </button>
                                                            @elseif ($order->status == 'rejected')
                                                                <button type="button" class="btn btn-danger">
                                                                    <i class="fa fa-close"></i> Cancelled
                                                                </button>
                                                            @endif
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="{{ route('admin.all_orders.view', ['o_id' => $order->o_id]) }}"
                                                                class="btn btn-primary">
                                                                Update Order Status
                                                            </a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">
                                                        <center>No Orders</center>
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
