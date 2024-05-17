
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
    </style>
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="1" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRunR8mq9MYERvPi5vDff-HHn4kFeJpXEpWO6cg0_Yzg&s" width="80" height="45" alt=""></a></li>
                <li><a href="#" class="nav-link px-2 text-white">Trang chủ</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Câu hỏi</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Về chúng tôi</a></li>
            </ul>



            <div class="d-flex gap-2 align-items-center">

                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                </form>

                @if (Session())
                    <p>{{Session('user_name')}}</p>
                @endif

            </div>
        </div>
    </div>

</header>
<h1 class="text-center">Sản phẩm quần áo</h1>
<div class="container ">
    <div class="row py-4 shadow-5 d-flex">
        @foreach($cloths as $item)
            <div  alt="Product Image" class="col col-4 m-3 card" style="width: 18rem"  data-id="{{$item->id}}">

                <img  src="{{ asset('storage/images/' . $item->product_image_url) }}" width="260" height="300"  alt="Product Image">
                <p >{{ $item->product_description }}</p>
                <h1>{{ $item->product_name }}</h1>
                <p>Price: {{ $item->product_price }}</p>
                <button  class=" btn btn-outline-dark me-1 "type="submit">Add</button>

            </div>

        @endforeach
    </div>
</div>


<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
            <a href="https://www.facebook.com/tao1407?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>


        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>Huy shop
                    </h6>
                    <p>
                        Cảm ơn bạn đã xem sản phẩm của chúng tôi. Ngoài ra,
                        đây là thông tin liên hệ và hỗ trợ khách hàng khi có sản phẩm
                        bị lỗi từ nhà sản xuất.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Sản phẩm
                    </h6>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Lego Batman</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Lego Ninjago</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Lego Chima</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Lego Nexo</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Hỗ trợ khách hàng
                    </h6>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Q&A</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Advise</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Orders</a>
                    </p>
                    <p>
                        <a  href="#!" class="text-reset" style="text-decoration: none">Help</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Liên lạc</h6>
                    <p><i class="fas fa-home me-3"></i> Hanoi,Hadong Vietnam</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        LEGOshop@gmail.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 0563 456 195</p>
                    <p><i class="fas fa-print me-3"></i> + 0904 775 377</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">

        Domestic goods:
        <a class="text-reset fw-bold">Cloth SHOP VIP123</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</body>

</html>
