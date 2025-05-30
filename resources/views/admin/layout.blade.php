<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 8|7|6 CRUD App Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <style>
        .push-top {
            margin-top: 50px;
        }
        .hidden-form {
            display: None;
        }
    </style>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href='{{ route("Cloths.index") }}' ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRunR8mq9MYERvPi5vDff-HHn4kFeJpXEpWO6cg0_Yzg&s" width="70" height="45" alt=""></a></li>
                    <li><a href="{{ route("Cloths.index") }}" class="nav-link px-2 text-white">Sản phẩm</a></li>
                    <li><a href="{{route("statistic")}}" class="nav-link px-2 text-white">Thống kê doanh thu </a></li>
                    <li><a href="{{route('order','Chờ duyệt đơn')}}" class="nav-link px-2 text-white">Orders </a></li>
                </ul>



                <div class="d-flex gap-2 align-items-center">

                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                    </form>

                </div>
            </div>
        </div>

    </header>
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/js"></script>
</body>
</html>
