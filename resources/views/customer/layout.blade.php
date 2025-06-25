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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .main-header {
            background: white;
            color: #333;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }

        /* Left Menu */
        .left-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .menu-item {
            position: relative;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 10px 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background-color: #f8f9fa;
            color:rgb(246, 95, 7);
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* Special styling for Sale item */
        .menu-item.sale-item {
            color: #dc3545;
            font-weight: 600;
        }

        .menu-item.sale-item:hover {
            color: #dc3545;
            background-color: #f8f9fa;
        }

        /* Dropdown Menu */
        .dropdown-menu-custom {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 200px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            border-radius: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
            padding: 10px 0;
        }

        .menu-item {
            position: relative;
        }

        .menu-item .dropdown-menu-custom {
            display: none;
        }

        .menu-item:hover .dropdown-menu-custom {
            display: block;
            animation: slideDown 0.3s ease forwards;
            visibility: visible;
            opacity: 1;
        }


        .dropdown-item-custom {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .dropdown-item-custom:hover {
            background-color: #f8f9fa;
            color: #007bff;
            text-decoration: none;
        }

        /* Center Banner/Logo */
        .center-banner {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-banner {
            text-decoration: none;
        }

        .logo-banner img {
            width: 100%;
            height: 60px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .logo-banner:hover img {
            transform: scale(1.1);
        }

        /* Right Section */
        .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Search Bar */
        .search-container {
            position: relative;
        }

        .search-form {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 25px;
            padding: 8px 15px;
            transition: all 0.3s ease;
            width: 250px;
        }

        .search-form:focus-within {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }

        .search-input {
            border: none;
            background: none;
            outline: none;
            flex: 1;
            padding: 5px 10px;
            color: #333;
            font-size: 14px;
        }

        .search-input::placeholder {
            color: #6c757d;
        }

        .search-btn {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 5px;
            transition: color 0.3s ease;
        }

        .search-btn:hover {
            color: #007bff;
        }

        /* Right Icons */
        .icon-item {
            position: relative;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .icon-item:hover {
            background: #007bff;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }

        .icon-item i {
            font-size: 20px;
            color: #333;
            transition: all 0.3s ease;
        }

        .icon-item:hover i {
            color: white;
            transform: scale(1.2);
        }

        /* Icon Dropdown */
        .icon-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
            border-radius: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
            padding: 10px 0;
            margin-top: 10px;
        }

        .icon-item:hover .icon-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .icon-dropdown-item {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .icon-dropdown-item:hover {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
        }

        .icon-dropdown-item i {
            margin-right: 10px;
            width: 16px;
            color: inherit;
        }

        /* Cart Badge */
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .left-menu {
                gap: 15px;
            }
            
            .menu-item {
                font-size: 14px;
                padding: 8px 10px;
            }
            
            .search-form {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 0 15px;
                flex-wrap: wrap;
                height: auto;
                min-height: 80px;
            }
            
            .left-menu {
                order: 3;
                width: 100%;
                justify-content: center;
                padding: 10px 0;
                gap: 10px;
            }
            
            .center-banner {
                order: 1;
                flex: none;
            }
            
            .right-section {
                order: 2;
                gap: 10px;
            }
            
            .search-form {
                width: 150px;
            }
            
            .menu-item {
                font-size: 12px;
                padding: 5px 8px;
            }
        }

        /* Animation */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu-custom,
        .icon-dropdown {
            animation: slideDown 0.3s ease;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <!-- Left Menu -->
        <nav class="left-menu">
            <!-- Nữ -->
            <div class="menu-item">
                <a href="#" class="menu-item">Nữ</a>
                <div class="dropdown-menu-custom">
                    <a href="#" class="dropdown-item-custom">Áo sơ mi nữ</a>
                    <a href="#" class="dropdown-item-custom">Áo thun nữ</a>
                    <a href="#" class="dropdown-item-custom">Áo khoác nữ</a>
                    <a href="#" class="dropdown-item-custom">Quần jean nữ</a>
                    <a href="#" class="dropdown-item-custom">Quần tây nữ</a>
                    <a href="#" class="dropdown-item-custom">Váy ngắn</a>
                    <a href="#" class="dropdown-item-custom">Váy dài</a>
                    <a href="#" class="dropdown-item-custom">Đầm công sở</a>
                    <a href="#" class="dropdown-item-custom">Túi xách</a>
                    <a href="#" class="dropdown-item-custom">Giày cao gót</a>
                </div>
            </div> 

            <!-- Nam -->
            <div class="menu-item"> 
                <a href="#" class="menu-item">Nam</a>
                <div class="dropdown-menu-custom">
                    <a href="#" class="dropdown-item-custom">Áo sơ mi nam</a>
                    <a href="#" class="dropdown-item-custom">Áo thun nam</a>
                    <a href="#" class="dropdown-item-custom">Áo khoác nam</a>
                    <a href="#" class="dropdown-item-custom">Quần jean nam</a>
                    <a href="#" class="dropdown-item-custom">Quần tây nam</a>
                    <a href="#" class="dropdown-item-custom">Quần short</a>
                    <a href="#" class="dropdown-item-custom">Vest nam</a>
                    <a href="#" class="dropdown-item-custom">Giày thể thao</a>
                    <a href="#" class="dropdown-item-custom">Phụ kiện nam</a>
                </div>
            </div>

            <!-- Đại tiệc mùa hè -->
            <div class="menu-item sale-item">
                <a href="" class="menu-item sale-item">Đại tiệc mùa hè - Sale tới 70% </a>
                <div class="dropdown-menu-custom">
                    <a href="#" class="dropdown-item-custom"> Sale 50% - Áo thun</a>
                    <a href="#" class="dropdown-item-custom"> Sale 60% - Quần short</a>
                    <a href="#" class="dropdown-item-custom"> Sale 70% - Váy hè</a>
                    <a href="#" class="dropdown-item-custom"> Hot Deals - Đồ bơi</a>
                    <a href="#" class="dropdown-item-custom"> Flash Sale - Sandal</a>
                    <a href="#" class="dropdown-item-custom"> Mega Deal - Set đồ hè</a>
                </div>
            </div>

            <!-- Bộ sưu tập -->
            <div class="menu-item">
                <a href="" class="menu-item">Bộ sưu tập</a>
             <a href="#" class="menu-item">
                
                <div class="dropdown-menu-custom">
                    <a href="#" class="dropdown-item-custom"> Spring Collection</a>
                    <a href="#" class="dropdown-item-custom"> Summer Collection</a>
                    <a href="#" class="dropdown-item-custom"> Fall Collection</a>
                    <a href="#" class="dropdown-item-custom"> Winter Collection</a>
                    <a href="#" class="dropdown-item-custom"> Premium Collection</a>
                    <a href="#" class="dropdown-item-custom"> Limited Edition</a>
                </div>
            </div>

            <!-- Về chúng tôi
            <div class="menu-item">
                <a href="" class="menu-item">Về chúng tôi</a>
                <div class="dropdown-menu-custom">
                    <a href="#" class="dropdown-item-custom"> Hoạt động cộng đồng</a>
                    <a href="#" class="dropdown-item-custom"> Tầm nhìn sứ mệnh</a>
                    <a href="#" class="dropdown-item-custom"> Đội ngũ</a>
                    <a href="#" class="dropdown-item-custom"> Liên hệ</a>
                    <a href="#" class="dropdown-item-custom"> Hệ thống cửa hàng</a>
                    <a href="#" class="dropdown-item-custom"> Chính sách</a>
                </div>
            </a>
    -->


            <a href="{{ route('customer.showall') }} " class="menu-item">
                Sản phẩm
            </a>
        </nav>

        <!-- Center Banner/Logo -->
        <div class="center-banner">
            <a href="{{route('customer.home')}}" class="logo-banner">
                <img src="{{ asset("logo 5.jpg") }}" alt="Logo" >
            </a>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <!-- Search Bar -->
            <div class="search-container">
                <form class="search-form" method="get" action="{{route('search')}}">
                    <input type="search" class="search-input" name="term" placeholder="Tìm kiếm sản phẩm..." value="">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Support Icon -->
            <div class="icon-item">
                <i class="fas fa-headset"></i>
                <div class="icon-dropdown">
                    <a href="tel:1900123456" class="icon-dropdown-item">
                        <i class="fas fa-phone" style="color: #63E6BE;"></i> Hotline: 1900 123 456
                    </a>
                    <a href="#" class="icon-dropdown-item">
                        <i class="fa-brands fa-facebook-messenger" style="color: #63E6BE;"></i> Messenger
                    </a>
                    <a href="#" class="icon-dropdown-item">
                        <i class="fas fa-comments" style="color: #63E6BE;"></i> Live Chat
                    </a>
                    <a href="mailto:support@example.com" class="icon-dropdown-item">
                        <i class="fas fa-envelope" style="color: #63E6BE;"></i> Email
                    </a>
                
                </div>
            </div>

            <!-- User Info Icon -->
            <div class="icon-item">
                <i class="fas fa-user"></i>
                <div class="icon-dropdown">
                    <!-- @if (Session('user_name'))
                        <a href="{{ route('profile', Session('id') ) }}" class="icon-dropdown-item">
                            <i class="fas fa-user-circle" style="color: #63E6BE;"></i> Thông tin cá nhân
                        </a>
                        <a href="{{route('order.history', Session('user_name'))}}" class="icon-dropdown-item">
                            <i class="fas fa-history" style="color: #63E6BE;"></i> Lịch sử đơn hàng
                        </a>
                        <form method="post" action="{{route('logout')}}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="icon-dropdown-item">
                                <i class="fas fa-sign-out-alt" style="color: #63E6BE;"></i> Đăng xuất
                            </button>
                        </form>
                        @if (Session('role') == 'admin')
                            <a href="{{ route('Cloths.index') }}" class="icon-dropdown-item">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @endif
                        @else
                            <a href="{{route('login')}}" class="icon-dropdown-item">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        @endif -->
                        @if (Session('role') == 'customer')
                            <a href="{{ route('profile', Session('id')) }}" class="icon-dropdown-item">
                                <i class="fas fa-user-circle" style="color: #63E6BE;"></i> Thông tin cá nhân
                            </a>
                            <a href="{{ route('order.history', Session('id')) }}" class="icon-dropdown-item">
                                <i class="fas fa-history" style="color: #63E6BE;"></i> Lịch sử đơn hàng
                            </a>
                            <form method="post" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="icon-dropdown-item">
                                    <i class="fas fa-sign-out-alt" style="color: #63E6BE;"></i> Đăng xuất
                                </button>
                            </form>

                        @elseif (Session('role') == 'admin')
                            <form method="post" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="icon-dropdown-item">
                                    <i class="fas fa-sign-out-alt" style="color: #63E6BE;"></i> Đăng xuất
                                </button>
                            </form>
                            <a href="{{ route('Cloths.index') }}" class="icon-dropdown-item">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @else

                            <a href="{{ route('login') }}" class="icon-dropdown-item">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        @endif
                </div>
            </div>

            <!-- Cart Icon -->
            <div class="icon-item">
                <form action="{{route('showcart',1)}}" method="GET" style="margin: 0;">
                    <button type="submit" style="background: none; border: none; position: relative; color: inherit;">
                        <i class="fas fa-shopping-cart"></i>
                        @if(Session('cart'))
                            <?php $increment = 0; ?>
                            @foreach(Session('cart') as $item)
                                <?php $increment++; ?>
                            @endforeach
                            <span class="cart-badge">{{$increment}}</span>
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Content will be injected here -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>
</html>