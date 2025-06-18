<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .vh-100 {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        .card-body {
            padding: 3rem 2.5rem !important;
            background: white;
        }

        /* Brand Section Styling */
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
            height: 100%;
            min-height: 500px;
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
            font-family: 'Poppins', sans-serif;
        }

        .brand-tagline {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        .brand-description {
            position: relative;
            z-index: 2;
            opacity: 0.8;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
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

        /* Form Title */
        .fw-normal.mb-3.pb-3 {
            color: #4a5568 !important;
            font-size: 1.3rem !important;
            font-weight: 500 !important;
            text-align: center;
            margin-bottom: 2rem !important;
            letter-spacing: 0.5px !important;
        }

        /* Form Styling */
        .form-outline {
            position: relative;
            margin-bottom: 1.8rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 16px;
            background: #f8fafc;
            transition: all 0.3s ease;
            height: auto;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .form-control-lg {
            padding: 1rem 1.25rem;
            font-size: 16px;
        }

        .form-label {
            position: absolute;
            top: 1rem;
            left: 1.25rem;
            color: #718096;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
            background: transparent;
            margin: 0;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label,
        .form-control:valid + .form-label {
            top: -10px;
            left: 15px;
            font-size: 12px;
            color: #667eea;
            background: white;
            padding: 0 8px;
            font-weight: 600;
        }

        /* Button Styling */
        .btn-dark {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 15px 2rem !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            color: white !important;
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .btn-dark::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-dark:hover::before {
            left: 100%;
        }

        .btn-dark:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4) !important;
            background: linear-gradient(45deg, #5a67d8, #6b46c1) !important;
        }

        .btn-lg {
            padding: 15px 2rem !important;
        }

        .btn-block {
            width: 100%;
        }

        /* Link Styling */
        .small.text-muted {
            color: #667eea !important;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
            display: block;
            text-align: center;
            margin-bottom: 1rem;
        }

        .small.text-muted:hover {
            color: #764ba2 !important;
            text-decoration: underline;
        }

        .mb-5.pb-lg-2 {
            text-align: center;
            color: #718096 !important;
            font-size: 15px;
        }

        .mb-5.pb-lg-2 a {
            color: #667eea !important;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .mb-5.pb-lg-2 a:hover {
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
            .card-body {
                padding: 2rem 1.5rem !important;
            }
            
            .brand-logo {
                font-size: 2.5rem;
            }
            
            .fw-normal.mb-3.pb-3 {
                font-size: 1.1rem !important;
            }

            .brand-section {
                padding: 2rem;
                min-height: 300px;
            }
            
            .fashion-icons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Form Animation */
        .form-outline {
            animation: slideUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-outline:nth-child(1) { animation-delay: 0.1s; }
        .form-outline:nth-child(2) { animation-delay: 0.2s; }
        .pt-1.mb-4 { 
            animation: slideUp 0.6s ease forwards;
            animation-delay: 0.3s;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Row improvements */
        .row.g-0 {
            min-height: 600px;
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card">
                    <div class="row g-0">
                        <!-- Brand Section -->
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <div class="brand-section">
                                <div class="brand-logo">TIN TIN</div>
                                <div class="brand-tagline">Fashion Forward • Style Redefined</div>
                                <p class="brand-description">
                                    Chào mừng bạn trở lại! Đăng nhập để khám phá thế giới thời trang độc đáo 
                                    và trải nghiệm mua sắm tuyệt vời cùng chúng tôi.
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
                        
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="post">
                                    @csrf
                                    
                                    <div class="d-flex align-items-center mb-3 pb-1" style="justify-content: center; margin-bottom: 2rem !important; padding-bottom: 1rem !important;">
                                        <i class="fas fa-tshirt" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-size: 2.5rem !important; margin-right: 15px !important;"></i>
                                        <span class="h1 fw-bold mb-0" style="font-size: 2.2rem; background: linear-gradient(45deg, #2d3748, #4a5568); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 700; letter-spacing: -0.5px;">TinTin</span>
                                    </div>
                                    
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập vào tài khoản của bạn</h5>
                                    
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input name="email" type="email" id="form2Example17" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example17">Địa chỉ email</label>
                                    </div>
                                    
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input name="password" type="password" id="form2Example27" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example27">Mật khẩu</label>
                                    </div>
                                    
                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Đăng nhập</button>
                                    </div>
                                    
                                    <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a href="/register" style="color: #393f81;">Đăng ký tại đây</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>