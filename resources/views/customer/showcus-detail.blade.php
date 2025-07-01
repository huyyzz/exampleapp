@extends('customer.layout')
@section('content')

<section class="py-5">
    <div class="container">
        <div class="row align-items-start gx-4 gy-4">
            
            <!-- Left: Image -->
            <div class="col-12 col-md-6">
                <img src="{{ asset('storage/images/' . $cloth->images[0]->image_url) }}" class="img-fluid" alt="Product Image">
            </div>

            <!-- Right: Product Details -->
            <div class="col-12 col-md-6">
                <h1 class="display-5 fw-bold">{{ $cloth->product_name }}</h1>
                <h2 class="text-danger mt-4">{{ number_format($cloth->skus[0]->price, 0, ',', '.') }} VNĐ</h2>

                <div class="lead mt-3">
                    Mô tả sản phẩm
                    <br>
                    {!! nl2br(e($cloth->product_description)) !!}
                </div>
                <form class="mt-4" method="get" action="{{ route('addToCart', $cloth->id) }}">
                    <label>Kích cỡ:</label>
                    <div class="mb-3" id="sizeButtons">
                        @foreach($cloth->skus as $sku)
                            <button 
                                type="button" 
                                class="btn btn-outline-dark me-2 mb-2 size-btn" 
                                data-sku-id="{{ $sku->id }}" 
                                data-quantity="{{ $sku->quantity }}"
                                data-size="{{ $sku->skuValues[0]->optionValue->value }}">
                                {{ $sku->skuValues[0]->optionValue->value }}
                            </button>
                        @endforeach
                    </div>
<!-- Value default la lay size dau tien -->
                    <input type="hidden" name="sku_id" id="selectedSkuId" value="{{ $cloth->skus[0]->id }}">

                    <label>Số lượng:</label>
                    <div class="d-flex align-items-center mb-3">
                        <input id="quantityInput" type="number" name="inputQuantity" min="1" max="{{ $cloth->skus[0]->quantity ?? 999 }}" value="1" class="form-control w-auto me-3">
                        <span id="quantityAvailable" class="text-muted">{{ $cloth->skus[0]->quantity }} sản phẩm có sẵn</span>
                    </div>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-cart-fill me-1"></i> Thêm vào giỏ
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
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
                        <i class="fas fa-gem me-3"></i>TIN TIN 
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
                        <a href="#!" class="text-reset" style="text-decoration: none">Help</a>
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
                        TINTINShop@gmail.com
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
        <a class="text-reset fw-bold">TIN TIN SHOP</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.size-btn');
        const quantityInput = document.getElementById('quantityInput');
        const quantityAvailable = document.getElementById('quantityAvailable');
        const selectedSkuId = document.getElementById('selectedSkuId');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Update hidden input
                selectedSkuId.value = this.getAttribute('data-sku-id');

                // Update quantity
                const quantity = this.getAttribute('data-quantity');
                quantityInput.max = quantity;
                quantityInput.value = 1;
                quantityAvailable.textContent = `${quantity} sản phẩm có sẵn`;

                // Highlight selected button
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
</body>
</html>
@endsection('content')
