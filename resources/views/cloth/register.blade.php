<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký - Tin Tin Fashion</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .vh-100 {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .register-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .register-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        .brand-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .brand-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .brand-logo {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            z-index: 2;
        }

        .brand-tagline {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        .fashion-icons {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            position: relative;
            z-index: 2;
        }

        .fashion-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
        }

        .fashion-icon:nth-child(2) {
            animation-delay: -1s;
        }

        .fashion-icon:nth-child(3) {
            animation-delay: -2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .fashion-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .form-section {
            padding: 3rem;
            background: white;
        }

        .form-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            transition: all 0.3s ease;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px 15px 60px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 1.1rem;
            z-index: 3;
        }

        .form-label {
            position: absolute;
            left: 60px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            transition: all 0.3s ease;
            pointer-events: none;
            font-size: 1rem;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: -10px;
            left: 15px;
            font-size: 0.85rem;
            color: #667eea;
            background: white;
            padding: 0 5px;
            border-radius: 5px;
            font-weight: 600;
        }

        .error-message {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 1rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .register-btn {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 15px 50px !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            color: white !important;
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4) !important;
            background: linear-gradient(45deg, #5a67d8, #6b46c1) !important;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #718096;
        }

        .login-link a {
            color: #667eea !important;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2 !important;
            text-decoration: underline;
        }

        /* Container Improvements */
        .container {
            padding: 2rem 1rem;
        }

        .col-xl-10 {
            max-width: 900px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .brand-section {
                padding: 2rem;
            }
            
            .form-section {
                padding: 2rem;
            }
            
            .brand-logo {
                font-size: 2.5rem;
            }
            
            .fashion-icons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Form Animation */
        .form-group {
            animation: slideUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .d-grid { 
            animation: slideUp 0.6s ease forwards;
            animation-delay: 0.6s;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <div class="register-card">
                        <div class="row g-0">
                            <!-- Brand Section -->
                            <div class="col-md-6">
                                <div class="brand-section h-100">
                                    <div class="brand-logo">TIN TIN</div>
                                    <div class="brand-tagline">Fashion Forward • Style Redefined</div>
                                    <p style="position: relative; z-index: 2; opacity: 0.8;">
                                        Khám phá thế giới thời trang độc đáo với những bộ sưu tập mới nhất. 
                                        Tạo tài khoản để trải nghiệm mua sắm tuyệt vời và nhận những ưu đãi đặc biệt.
                                    </p>
                                    <div class="fashion-icons">
                                        <div class="fashion-icon">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <div class="fashion-icon">
                                            <i class="fas fa-female"></i>
                                        </div>
                                        <div class="fashion-icon">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Section -->
                            <div class="col-md-6">
                                <div class="form-section">
                                    <h2 class="form-title">Tạo Tài Khoản Mới</h2>
                                    
                                    <form method="post" action="">
                                        @if($errors->any())
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                {{$errors->first()}}
                                            </div>
                                        @endif
                                        
                                        @csrf
                                        
                                        <div class="form-group">
                                            <div class="input-wrapper">
                                                <i class="fas fa-user input-icon"></i>
                                                <input type="text" id="name" name="name" class="form-control" placeholder=" " required />
                                                <label class="form-label" for="name">Tên của bạn</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-wrapper">
                                                <i class="fas fa-envelope input-icon"></i>
                                                <input type="email" id="email" name="email" class="form-control" placeholder=" " required />
                                                <label class="form-label" for="email">Email của bạn</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-wrapper">
                                                <i class="fas fa-lock input-icon"></i>
                                                <input type="password" id="password" name="password" class="form-control" placeholder=" " required />
                                                <label class="form-label" for="password">Mật khẩu</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-wrapper">
                                                <i class="fas fa-map-marker-alt input-icon"></i>
                                                <input type="text" id="address" name="address" class="form-control" placeholder=" " required />
                                                <label class="form-label" for="address">Địa chỉ</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-wrapper">
                                                <i class="fas fa-phone input-icon"></i>
                                                <input type="text" id="phone" name="phone" class="form-control" placeholder=" " required />
                                                <label class="form-label" for="phone">Số điện thoại</label>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="register-btn">
                                                <i class="fas fa-user-plus me-2"></i>
                                                Tạo Tài Khoản
                                            </button>
                                        </div>
                                        
                                        <div class="login-link">
                                            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to button
            const button = document.querySelector('.register-btn');
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>
    
    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>