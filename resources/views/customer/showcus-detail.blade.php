@extends('customer.layout')
@section('content')
<style>

    button:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
        opacity: 0.7;
    }
    /* Product Detail Styles */
.product-gallery {
    display: flex;
    gap: 16px;
    margin-bottom: 32px;
}

.main-image-container {
    flex: 1;
    position: relative;
    max-width: 600px;
}

.main-image {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.image-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.image-nav-btn:hover {
    background: white;
    transform: translateY(-50%) scale(1.1);
}

.image-nav-btn.prev {
    left: 16px;
}

.image-nav-btn.next {
    right: 16px;
}

.thumbnail-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 120px;
}

.thumbnail-nav {
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-height: 600px;
    overflow-y: auto;
}

.thumbnail-nav::-webkit-scrollbar {
    width: 4px;
}

.thumbnail-nav::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.thumbnail-nav::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 2px;
}

.thumbnail {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.thumbnail:hover {
    transform: scale(1.05);
    border-color: #007bff;
}

.thumbnail.active {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

.thumbnail-nav-btn {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    width: 100px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
    color: #666;
}

.thumbnail-nav-btn:hover {
    background: #e9ecef;
    border-color: #adb5bd;
}

.thumbnail-nav-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.product-info {
    max-width: 500px;
}

.product-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 16px;
    line-height: 1.2;
}

.product-price {
    font-size: 28px;
    font-weight: 600;
    color: #e74c3c;
    margin-bottom: 8px;
}

.product-original-price {
    font-size: 20px;
    color: #999;
    text-decoration: line-through;
    margin-left: 12px;
}

.product-sku {
    font-size: 14px;
    color: #666;
    margin-bottom: 24px;
}

.product-options {
    margin-bottom: 32px;
}

.option-group {
    margin-bottom: 20px;
}

.option-label {
    font-size: 16px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

.size-options {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.size-option {
    padding: 8px 16px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    background: white;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    min-width: 44px;
    text-align: center;
}

.size-option:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.size-option.selected {
    border-color: #007bff;
    background: #007bff;
    color: white;
}

.size-option.unavailable {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f8f9fa;
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}

.quantity-input {
    width: 80px;
    padding: 8px 12px;
    border: 2px solid #dee2e6;
    border-radius: 6px;
    text-align: center;
    font-weight: 500;
}

.quantity-btn {
    width: 36px;
    height: 36px;
    border: 2px solid #dee2e6;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.stock-info {
    font-size: 14px;
    color: #666;
    margin-bottom: 24px;
}

.add-to-cart-btn {
    background: #333;
    color: white;
    border: none;
    padding: 16px 32px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 16px;
}

.add-to-cart-btn:hover {
    background: #555;
    transform: translateY(-2px);
}

.product-actions {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
}

.action-btn {
    flex: 1;
    padding: 12px 24px;
    border: 2px solid #dee2e6;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: 500;
}

.action-btn:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.product-description {
    border-top: 1px solid #dee2e6;
    padding-top: 24px;
}

.description-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #333;
}

.description-content {
    color: #666;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
    .product-gallery {
        flex-direction: column;
    }
    
    .thumbnail-container {
        max-width: 100%;
    }
    
    .thumbnail-nav {
        flex-direction: row;
        max-height: none;
        overflow-x: auto;
        overflow-y: hidden;
        padding-bottom: 8px;
    }
    
    .thumbnail {
        min-width: 80px;
        width: 80px;
        height: 80px;
    }
    
    .main-image {
        height: 400px;
    }
    
    .product-title {
        font-size: 24px;
    }
    
    .product-price {
        font-size: 22px;
    }
}

</style>
<section class="py-5">
    <div class="container">
        <div class="row align-items-start gx-4 gy-4">
            
            <!-- Left: Image -->
            <div class="col-12 col-md-6">
                @foreach ($cloth->images as $image )
                    <img src="{{ asset('storage/images/' . $image->image_url) }}" class="img-fluid" alt="Product Image">
                @endforeach
                <img src="{{ asset('storage/images/' . $cloth->images[0]->image_url) }}" class="img-fluid" alt="Product Image" style="max-width: 100%; height: 500px;">
            </div>

            <!-- Right: Product Details -->
            <div class="col-12 col-md-6">
                <h1 class="display-5 fw-bold">{{ $cloth->product_name }}</h1>
                <h2 id="price_changing" class="text-danger mt-4">{{ number_format($cloth->skus[0]->price, 0, ',', '.') }} VNĐ</h2>

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
                                data-size="{{ $sku->skuValues[0]->optionValue->value }}"
                                data-price="{{$sku->price}}">
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

                    <!-- <h2 id="out-of-stock" class="text-danger mt-4" style="display: none">Hết hàng</h2> -->

                    <button id="cartAdd" type="submit" class="btn btn-dark">
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
        var stock = document.getElementById('out-of-stock');
        

        const buttons = document.querySelectorAll('.size-btn');
        const quantityInput = document.getElementById('quantityInput');
        const quantityAvailable = document.getElementById('quantityAvailable');
        const selectedSkuId = document.getElementById('selectedSkuId');
        const price = document.getElementById('price_changing')

        var quantityConLai = quantityInput.max
        buttons.forEach(button => {
            if (button.getAttribute('data-quantity') == 0){
                button.disabled = true
                button.selected = false
            }
            if (button.getAttribute('data-quantity') != 0){
                button.disabled = false
                button.selected = true
            }

        })
        if (quantityConLai == 0){
            // stock.style.display = "block"
            document.getElementById("cartAdd").disabled = true
        }

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                

                // Update hidden input
                selectedSkuId.value = this.getAttribute('data-sku-id');

                // Update quantity
                const quantity = this.getAttribute('data-quantity');
                quantityInput.max = quantity;
                quantityInput.value = 1;
                quantityAvailable.textContent = `${quantity} sản phẩm có sẵn`;
                console.log(quantity)
                if (quantity != 0){
                    // stock.style.display = "none"
                    document.getElementById("cartAdd").disabled = false
                }
                if (quantity == 0){
                    // stock.style.display = "block"
                    document.getElementById("cartAdd").disabled = true
                }
                
                const pricing = this.getAttribute('data-price');

                price.innerHTML = Intl.NumberFormat("vi-VN", { style: "currency", currency: "VND" }).format(
                    pricing,
                );

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
