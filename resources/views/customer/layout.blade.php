
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>khach hang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 40%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
            padding: 2px 16px;
        }
        header{
            display: flex;
            justify-content: space-between;
            padding :  0 50px ;
            height: 70px;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1;
            background: rgba(255,255,255,0.3);
        }
        header.sticky{
            background: rgba(255,255,255,1);
        }
        header:hover{
            background: rgba(255,255,255,1);
        }
        li{
            list-style: none;
        }
        a{
            text-decoration: none;
        }

        .logo{

            /*flex: 50px;*/
        }

        .menu{
            margin-left: 2rem;
            justify-content: left;
            display: flex;
        }
        .menu >li{
            padding : 0 12px ;
            position: relative;
        }
        .menu > li:hover .sub-menu{
            display: block;
            visibility: visible;
            top: 45px;
        }
        .sub-menu{
            position: absolute;
            width: 150px;
            border: 1px solid #ccc;
            padding: 10px 0 10px 20px;
            display: none;
            z-index: 1;
            transition: 0.3s;
            background: #ffff;
            visibility: hidden;

        }
        .sub-menu ul {
            padding-left: 20px;
        }
        .sub-menu ul a {
            font-weight: normal;
            font-size:  18px;
        }



        .menu li > a{
            font-size:  18px;
            font-weight: bold ;
            display: block;
            line-height: 20px;
        }
        .content {
            margin-top: 5rem;
        }
        .reF{
            margin-left: auto;
        }

        .loginBtn {

        }


        .loginBtn > a:link {
            color: white!important;
        }
        .loginBtn > a:hover{
            color: black!important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="1" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <div class="logo">
                <ul class="float-start nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{route('customer.home')}}" ><img src="https://insacmau.com/wp-content/uploads/2024/11/logo-shop-quan-ao-nu-9.jpg" width="60px" height="60px" alt=""></a></li>
                </ul>
            </div>


            <div class="menu dropdown">
                <button style="border: none" class="text-bg-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Brands
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach($brands as $brand)
                        <li>
                            <a href="{{route('specific',$brand->name)}}" class="nav-link px-2 btn-outline-dark">{{$brand->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <form class="menu" method="get" action="{{route('search')}}">
                <div class="input-group form-control">
                    <input type="search" class="border-0 form-control" aria-label="Search" aria-describedby="search-addon" name="term" value="" placeholder="Tìm kiếm sản phẩm">
                    <button style="background: none" type="submit" class="border-0">
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span>
                    </button>
                </div>
            </form>
{{--            <div class="menu dropdown">--}}
{{--                <button style="border: none" class="text-bg-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                    Categories--}}
{{--                </button>--}}
{{--                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <li>--}}
{{--                            <a href="{{route('specific',$category->name)}}" class="nav-link px-2 btn-outline-dark">{{$brand->name}}</a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
            <div class="d-flex gap-2 align-items-center reF">
                @if (Session('user_name'))
                    <form action="{{route('order.history', Session('user_name'))}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light me-2 loginBtn" >Lịch sử đơn hàng</button>
                    </form>

                    <form action="{{route('showcart',1)}}" class="d-flex">
                        <button class="btn btn-outline-light me-2" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            @if(Session('cart'))
                                    <?php
                                    $increment = 0;
                                    ?>
                                @foreach(Session('cart') as $item)
                                        <?php
                                        $increment++;
                                        ?>
                                @endforeach
                                <span class="badge bg-danger text-white ms-1 rounded-pill">{{$increment}}</span></a>
                            @endif
                        </button>
                    </form>
                    <div>
                        <div class="dropdown">
                            <button class="text-bg-dark" style="border: none" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Hi {{Session('user_name')}}
                            </button>
                            <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton2">
                                @if (Session('role') == 'admin')
                                    <a href="{{ route('profile', Session('id') )}}">Thông tin cá nhân</a>
                                    <hr>
                                    <a href="{{ route('Cloths.index') }}">Dashboard</a>
                                @else
                                    <div class="">
                                        <!-- <ul> -->
                                            <button class="btn" >
                                                <a href="{{ route('profile', Session('id') ) }}">Thông tin</a>
                                            </button>
                                        <!-- </ul> -->
                                    
                                    <form method="post" action="{{route('logout')}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                                    </form>
                                    </div>
                                @endif

                            </div>
                        </div>


                    </div>

                    
                @else
                    <form action="{{route('login')}}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light me-2 loginBtn" >Đăng nhập</button>
                    </form>
                @endif

            </div>
        </div>
    </div>

{{--    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>--}}
</header>
<div class="content">
    @yield('content')
</div>

@yield('scripts')
