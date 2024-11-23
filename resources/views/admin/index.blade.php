<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">

</head>
<body>
    <div class="container">
        <div class="info">
            <h1>Admin Panel</h1>
        </div>
    </div>
    <div class="form">
        <div class="thumbnail"><img src="{{ asset('images/manager.png') }}"/></div>

        <!-- Display Error Messages -->
        @if ($errors->any())
            <span style="color:red;">{{ $errors->first() }}</span>
        @endif

        <!-- Display Success Messages -->
        @if (session('success'))
            <span style="color:green;">{{ session('success') }}</span>
        @endif

        <form class="login-form" action="{{ route('admin.login.submit') }}" method="post">
            @csrf
            <input type="text" placeholder="Username" name="username" required/>
            <input type="password" placeholder="Password" name="password" required/>
            <input type="submit" name="submit" value="Login"/>
        </form>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
