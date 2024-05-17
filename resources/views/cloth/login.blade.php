<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
</head>
<body>
<section class="vh-100" style="background-color: yellow;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10" >
                <div class="card">
                    <div class="row g-0">
                        <img  class="col-md-6 col-lg-5 d-none d-md-block" src="https://vn-test-11.slatic.net/p/c42c28a5ab1ce64932e33961f4c53347.jpg"
                             alt="login form" class="img-fluid "  />

                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form method="post">
                                    @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Huy Shop</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="l    etter-spacing: 1px;">Sign into your account</h5>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input name="email" type="email" id="form2Example17" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example17">Email address</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input name="password" type="password" id="form2Example27" class="form-control form-control-lg" />
                                        <label class="form-label" for="form2Example27">Password</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <a class="small text-muted" href="#!">Forgot password?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/register"
                                                                                                              style="color: #393f81;">Register here</a></p>

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
