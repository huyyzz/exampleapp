@extends('customer.layout')
@section('content')

<section class="py-5">
    <div class="container">
        <div class="row align-items-start gx-4 gy-4">
            
            <!-- Left: Image -->
            <div class="col-12 col-md-6">
                <img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" class="img-fluid" alt="Product Image">
            </div>

            <!-- Right: Product Details -->
            <div class="col-12 col-md-6">
                <h1 class="display-5 fw-bold">{{ $cloth->product_name }}</h1>
                <h2 class="text-danger mt-4">{{ number_format($cloth->product_price, 0, ',', '.') }} VNĐ</h2>

                <div class="lead mt-3">
                    Mô tả sản phẩm
                    <br>
                    {!! nl2br(e($cloth->product_description)) !!}
                </div>

                <form class="mt-4" method="get" action="{{ route('addToCart', $cloth->id) }}">
                    <label>Số lượng:</label>
                    <div class="d-flex align-items-center mb-3">
                        <input type="number" name="inputQuantity" min="1" max="{{ $cloth->QuantityInWareHouse ?? 999 }}" value="1" class="form-control w-auto me-3">
                        <span class="text-muted">{{ $cloth->QuantityInWareHouse }} sản phẩm có sẵn</span>
                    </div>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-cart-fill me-1"></i> Thêm vào giỏ
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<<footer class="text-center text-lg-start bg-body-tertiary text-muted">
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
                    {{--                    <h6 class="text-uppercase fw-bold mb-4">--}}
                    {{--                        Sản phẩm--}}
                    {{--                    </h6>--}}
                    {{--                    <p>--}}
                    {{--                        <a href="#!" class="text-reset" style="text-decoration: none">Adidas</a>--}}
                    {{--                    </p>--}}
                    {{--                    <p>--}}
                    {{--                        <a href="#"  class="text-reset" style="text-decoration: none">Nike</a>--}}
                    {{--                    </p>--}}
                    {{--                    <p>--}}
                    {{--                        <a href="#!" class="text-reset" style="text-decoration: none">LV</a>--}}
                    {{--                    </p>--}}
                    {{--                    <p>--}}
                    {{--                        <a href="#!" class="text-reset" style="text-decoration: none">Gucci</a>--}}
                    {{--                    </p>--}}
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
                    <p><i class="fas fa-home me-3"></i> Hanoi, Hadong Vietnam</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        HUYShop@gmail.com
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
@endsection('content')
