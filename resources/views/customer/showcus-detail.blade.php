@extends('customer.layout')
@section('content')

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5">
            <div style="" class="col col-md-6"><img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" height="500px"  alt="Product Image"  ></div>
            <div class="col col-md-6">

                <h1 class="display-5 fw-bolder">{{ $cloth->product_name }} </h1>
                <div class="fs-5 mb-5">

                    <span><h2 class="text-danger" style="margin-top: 40px"> {{ $cloth->product_price }} VNĐ</h2></span>
                </div>
                <div class="lead ">
                    <?php
                        for ($i=0; $i < strlen($cloth->product_description); $i++) {
                            echo $cloth->product_description[$i];
                            if ($cloth->product_description[$i] == "\n") {
                                echo "<br>";
                            }
                        }
                    ?>
                </div>
                <div class="d-flex mt-3">
                    <form method="get" action="{{route('addToCart',$cloth->id)}}">
                        <label>Số lượng
                            <input class="text-center me-3" id="inputQuantity" name="inputQuantity" type="number" value="1" min="1" max="{{$cloth->QuantityInWareHouse}}" style="max-width: 7.25rem" />
                        </label>

                        <span style="color:#757575;opacity: .7">{{$cloth->QuantityInWareHouse}} sản phẩm có sẵn</span>
                        <br>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
{{--<!-- Related items section-->--}}
{{--<section class="py-5 bg-light">--}}
{{--    <div class="container px-4 px-lg-5 mt-5">--}}
{{--        <h2 class="fw-bolder mb-4">Related products</h2>--}}
{{--        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">--}}
{{--            <div class="col mb-5">--}}
{{--                <div class="card h-100">--}}
{{--                    <!-- Product image-->--}}
{{--                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />--}}
{{--                    <!-- Product details-->--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="text-center">--}}
{{--                            <!-- Product name-->--}}
{{--                            <h5 class="fw-bolder">Fancy Product</h5>--}}
{{--                            <!-- Product price-->--}}
{{--                            $40.00 - $80.00--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Product actions-->--}}
{{--                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">--}}
{{--                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col mb-5">--}}
{{--                <div class="card h-100">--}}
{{--                    <!-- Sale badge-->--}}
{{--                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>--}}
{{--                    <!-- Product image-->--}}
{{--                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />--}}
{{--                    <!-- Product details-->--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="text-center">--}}
{{--                            <!-- Product name-->--}}
{{--                            <h5 class="fw-bolder">Special Item</h5>--}}
{{--                            <!-- Product reviews-->--}}
{{--                            <div class="d-flex justify-content-center small text-warning mb-2">--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                            </div>--}}
{{--                            <!-- Product price-->--}}
{{--                            <span class="text-muted text-decoration-line-through">$20.00</span>--}}
{{--                            $18.00--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Product actions-->--}}
{{--                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">--}}
{{--                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col mb-5">--}}
{{--                <div class="card h-100">--}}
{{--                    <!-- Sale badge-->--}}
{{--                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>--}}
{{--                    <!-- Product image-->--}}
{{--                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />--}}
{{--                    <!-- Product details-->--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="text-center">--}}
{{--                            <!-- Product name-->--}}
{{--                            <h5 class="fw-bolder">Sale Item</h5>--}}
{{--                            <!-- Product price-->--}}
{{--                            <span class="text-muted text-decoration-line-through">$50.00</span>--}}
{{--                            $25.00--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Product actions-->--}}
{{--                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">--}}
{{--                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col mb-5">--}}
{{--                <div class="card h-100">--}}
{{--                    <!-- Product image-->--}}
{{--                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />--}}
{{--                    <!-- Product details-->--}}
{{--                    <div class="card-body p-4">--}}
{{--                        <div class="text-center">--}}
{{--                            <!-- Product name-->--}}
{{--                            <h5 class="fw-bolder">Popular Item</h5>--}}
{{--                            <!-- Product reviews-->--}}
{{--                            <div class="d-flex justify-content-center small text-warning mb-2">--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                                <div class="bi-star-fill"></div>--}}
{{--                            </div>--}}
{{--                            <!-- Product price-->--}}
{{--                            $40.00--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Product actions-->--}}
{{--                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">--}}
{{--                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- Footer-->
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
