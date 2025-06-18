    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laravel 8|7|6 CRUD App Example</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }

            .push-top {
                margin-top: 50px;
            }
            
            .hidden-form {
                display: none;
            }

            /* Layout Container */
            .admin-layout {
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar Styles */
            .sidebar {
                width: 280px;
                background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
                box-shadow: 4px 0 15px rgba(0,0,0,0.1);
                position: fixed;
                height: 100vh;
                overflow-y: auto;
                z-index: 1000;
                transition: all 0.3s ease;
            }

            .sidebar-header {
                padding: 25px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                text-align: center;
                background: rgba(0,0,0,0.2);
            }

            .sidebar-header img {
                width: 70px;
                height: 45px;
                border-radius: 8px;
                margin-bottom: 15px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            }

            .sidebar-header h3 {
                color: #ecf0f1;
                font-size: 20px;
                font-weight: 600;
                margin: 0;
            }

            .sidebar-menu {
                padding: 20px 0;
            }

            .menu-item {
                margin: 8px 15px;
                border-radius: 12px;
                transition: all 0.3s ease;
                overflow: hidden;
            }

            .menu-item:hover {
                background: rgba(255,255,255,0.1);
                transform: translateX(5px);
            }

            .menu-item a {
                display: flex;
                align-items: center;
                padding: 16px 20px;
                color: #bdc3c7;
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
                font-size: 15px;
            }

            .menu-item a:hover {
                color: #ecf0f1;
                text-decoration: none;
            }

            .menu-item.active {
                background: linear-gradient(135deg, #3498db, #2980b9);
                box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            }

            .menu-item.active a {
                color: white;
            }

            .menu-item i {
                font-size: 18px;
                margin-right: 15px;
                width: 25px;
                text-align: center;
            }

            .logout-section {
                position: absolute;
                bottom: 20px;
                left: 15px;
                right: 15px;
            }

            .logout-btn {
                width: 100%;
                padding: 15px;
                background: linear-gradient(135deg, #e74c3c, #c0392b);
                border: none;
                border-radius: 12px;
                color: white;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
                font-size: 15px;
            }

            .logout-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
            }

            .logout-btn i {
                margin-right: 8px;
            }

            /* Main Content Area */
            .main-content {
                flex: 1;
                margin-left: 280px;
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
                min-height: 100vh;
                transition: all 0.3s ease;
            }

            .top-header {
                background: white;
                padding: 20px 30px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                border-bottom: 1px solid #e9ecef;
                display: flex;
                justify-content: between;
                align-items: center;
            }

            .page-title {
                color: #2c3e50;
                font-size: 28px;
                font-weight: 700;
                margin: 0;
                flex: 1;
            }

            .content-wrapper {
                padding: 0;
            }

            /* Container for content */
            .container {
                max-width: 100%;
                padding: 0;
            }

            /* Mobile Responsive */
            .mobile-toggle {
                display: none;
            }

            @media (max-width: 768px) {
                .sidebar {
                    width: 250px;
                }

                .main-content {
                    margin-left: 250px;
                }

                .top-header {
                    padding: 15px 20px;
                }

                .sidebar-header h3 {
                    font-size: 16px;
                }

                .menu-item a {
                    padding: 12px 15px;
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                .sidebar {
                    width: 200px;
                }

                .main-content {
                    margin-left: 200px;
                }
            }

            /* Scrollbar Styling */
            .sidebar::-webkit-scrollbar {
                width: 6px;
            }

            .sidebar::-webkit-scrollbar-track {
                background: transparent;
            }

            .sidebar::-webkit-scrollbar-thumb {
                background: rgba(255,255,255,0.3);
                border-radius: 3px;
            }

            .sidebar::-webkit-scrollbar-thumb:hover {
                background: rgba(255,255,255,0.5);
            }

            /* Animation */
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .menu-item {
                animation: slideIn 0.3s ease forwards;
            }

            /* Badge for notifications */
            .menu-badge {
                background: #e74c3c;
                color: white;
                font-size: 10px;
                padding: 2px 6px;
                border-radius: 10px;
                margin-left: auto;
            }
        </style>
    </head>
    <body>


        <div class="admin-layout">
            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <img src="https://insacmau.com/wp-content/uploads/2024/11/logo-shop-quan-ao-nu-9.jpg" alt="Logo">
                    <h3>Admin đẳng cấp</h3>
                </div>
                
                <div class="sidebar-menu">
                    <div class="menu-item">
                        <a href="{{ route('Cloths.index') }}">
                            <i class="fas fa-tshirt"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </div>
                    
                    <div class="menu-item">
                        <a href="{{ route('statistic') }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Thống kê doanh thu</span>
                        </a>
                    </div>
                    
                    <div class="menu-item">
                        <a href="{{ route('order', 'Chờ duyệt đơn') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Đơn hàng</span>
                            <span class="menu-badge">{{ count($orders ?? []) }}</span>
                        </a>
                    </div>
                    
                    <div class="menu-item">
                        <a href="{{ route('Cloths.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>Thêm sản phẩm</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{ route('categories.index') }}">
                            <i class="fas fa-list"></i>
                            <span>Danh mục</span>
                        </a>

                    </div>
                    

                    <div class="menu-item">
                        <a href="#">
                            <i class="fas fa-users"></i>
                            <span>Quản lý người dùng</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="#">
                            <i class="fas fa-cog"></i>
                            <span>Cài đặt</span>
                        </a>
                    </div>
                </div>
                
                <div class="logout-section">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="top-header">
                    <h1 class="page-title">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </h1>
                </div>
                
                <div class="content-wrapper">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <script>
            // Auto-highlight active menu item
            document.addEventListener('DOMContentLoaded', function() {
                const currentUrl = window.location.href;
                const menuItems = document.querySelectorAll('.menu-item');
                
                menuItems.forEach(item => {
                    const link = item.querySelector('a');
                    const href = link.getAttribute('href');
                    
                    if (href && currentUrl.includes(href) && href !== '#') {
                        menuItems.forEach(mi => mi.classList.remove('active'));
                        item.classList.add('active');
                    }
                });

                // If no specific match, highlight "Sản phẩm" for Cloths routes
                if (currentUrl.includes('Cloths') || currentUrl.includes('cloths')) {
                    menuItems.forEach(mi => mi.classList.remove('active'));
                    menuItems[0].classList.add('active'); // First item is "Sản phẩm"
                }
            });

            // Smooth menu transitions
            document.querySelectorAll('.menu-item a').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add loading effect
                    const icon = this.querySelector('i');
                    const originalClass = icon.className;
                    icon.className = 'fas fa-spinner fa-spin';
                    
                    setTimeout(() => {
                        icon.className = originalClass;
                    }, 500);
                });
            });
        </script>
    </body>
    </html>