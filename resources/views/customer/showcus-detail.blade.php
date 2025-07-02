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
    .product-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .product-layout {
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }

    /* Image Gallery Styles */
    .product-gallery {
        flex: 1;
        max-width: 600px;
    }

    .main-image-container {
        position: relative;
        margin-bottom: 20px;
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
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        font-size: 18px;
        z-index: 2;
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

    /* New Thumbnail Gallery Styles */
    .thumbnail-container {
        position: relative;
        margin-top: 16px;
    }

    .thumbnail-gallery {
        overflow: hidden;
        border-radius: 8px;
    }

    .thumbnail-track {
        display: flex;
        transition: transform 0.3s ease;
        gap: 12px;
    }

    .thumbnail {
        flex: 0 0 calc(25% - 9px); /* 4 thumbnails per view with gap */
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
    }

    .thumbnail:hover {
        transform: scale(1.05);
        border-color: #333;
    }

    .thumbnail.active {
        border-color: #333;
        box-shadow: 0 0 0 2px rgba(51,51,51,0.25);
    }

    /* Thumbnail Navigation Buttons */
    .thumbnail-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.95);
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
        font-size: 16px;
        z-index: 3;
        color: #333;
    }

    .thumbnail-nav-btn:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }

    .thumbnail-nav-btn:disabled {
        opacity: 0.3;
        cursor: not-allowed;
        transform: translateY(-50%);
    }

    .thumbnail-nav-btn.prev {
        left: -15px;
    }

    .thumbnail-nav-btn.next {
        right: -15px;
    }

    /* Product Info Styles */
    .product-info {
        flex: 1;
        max-width: 500px;
        padding-left: 20px;
    }

    .product-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .product-sku {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .product-price {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 32px;
    }

    /* Product Options */
    .product-options {
        margin-bottom: 32px;
    }

    .option-group {
        margin-bottom: 24px;
    }

    .option-label {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 12px;
        display: block;
    }

    .size-options {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .size-option {
        padding: 12px 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        min-width: 50px;
        text-align: center;
        font-size: 14px;
    }

    .size-option:hover {
        border-color: #333;
        background: #f8f9fa;
    }

    .size-option.active {
        border-color: #333;
        background: #333;
        color: white;
    }

    .size-option.unavailable {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    /* Quantity Selector */
    .quantity-group {
        margin-bottom: 24px;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 8px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .quantity-btn {
        width: 44px;
        height: 44px;
        border: none;
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transition: all 0.3s ease;
        font-size: 18px;
    }

    .quantity-btn:hover {
        background: #f8f9fa;
    }

    .quantity-input {
        width: 80px;
        height: 44px;
        border: none;
        text-align: center;
        font-weight: 500;
        font-size: 16px;
    }

    .quantity-input:focus {
        outline: none;
    }

    .stock-info {
        font-size: 14px;
        color: #666;
    }

    /* Add to Cart Button */
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
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .add-to-cart-btn:hover {
        background: #555;
        transform: translateY(-2px);
    }

    /* Product Description */
    .product-description {
        border-top: 1px solid #eee;
        padding-top: 24px;
    }

    .description-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 16px;
        color: #333;
    }

    .description-content {
        max-height: 150px;
        overflow-y: auto;
        color: #666;
        line-height: 1.6;
        font-size: 14px;
        padding-right: 10px;
    }

    .description-content::-webkit-scrollbar {
        width: 6px;
    }

    .description-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .description-content::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    .description-content::-webkit-scrollbar-thumb:hover {
        background: #a1a1a1;
    }

    /* Responsive Design */
    @media (max-width: 968px) {
        .product-layout {
            flex-direction: column;
            gap: 32px;
        }
        
        .product-info {
            padding-left: 0;
            max-width: 100%;
        }
        
        .main-image {
            height: 500px;
        }
        
        .thumbnail {
            flex: 0 0 calc(33.333% - 8px); /* 3 thumbnails per view on tablet */
        }
    }

    @media (max-width: 576px) {
        .product-container {
            padding: 16px;
        }
        
        .product-title {
            font-size: 24px;
        }
        
        .product-price {
            font-size: 28px;
        }
        
        .main-image {
            height: 400px;
        }
        
        .size-options {
            gap: 8px;
        }
        
        .size-option {
            padding: 10px 16px;
            font-size: 13px;
        }
        
        .thumbnail {
            flex: 0 0 calc(50% - 6px); /* 2 thumbnails per view on mobile */
            height: 100px;
        }
        
        .thumbnail-nav-btn {
            width: 35px;
            height: 35px;
            font-size: 14px;
        }
.slide {
    display: flex;
    overflow-x: auto;
    gap: 10px;
    padding: 10px 5px;
    scrollbar-width: none;
}

.slide::-webkit-scrollbar {
    display: none;
}

.slide .item {
    min-width: 130px;
    background: #fff;
    padding: 10px;
    border-radius: 10px;
    flex-shrink: 0;
    transition: transform 0.2s ease;
    border: 1px solid #eee;
}

.slide .item:hover {
    transform: scale(1.03);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}
</style>

<div class="product-container">
    <div class="product-layout">
        <!-- Product Gallery -->
        <div class="product-gallery">
            <div class="main-image-container">
                <img id="mainImage" src="{{ asset('storage/images/' . $cloth->images[0]->image_url) }}" class="main-image" alt="{{ $cloth->product_name }}">
                
                @if(count($cloth->images) > 1)
                    <button class="image-nav-btn prev" id="prevBtn">‹</button>
                    <button class="image-nav-btn next" id="nextBtn">›</button>
                @endif
            </div>
            
            @if(count($cloth->images) > 1)
                <div class="thumbnail-container">
                    <div class="thumbnail-gallery">
                        <div class="thumbnail-track" id="thumbnailTrack">
                            @foreach($cloth->images as $index => $image)
                                <img src="{{ asset('storage/images/' . $image->image_url) }}" 
                                     class="thumbnail {{ $index === 0 ? 'active' : '' }}" 
                                     data-index="{{ $index }}"
                                     alt="Product Image {{ $index + 1 }}">
                            @endforeach
                        </div>
                    </div>
                    
                    @if(count($cloth->images) > 4)
                        <button class="thumbnail-nav-btn prev" id="thumbnailPrevBtn">‹</button>
                        <button class="thumbnail-nav-btn next" id="thumbnailNextBtn">›</button>
                    @endif
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="product-info">
           
            <h1 class="product-title">{{ $cloth->product_name }}</h1>
            <div id="price_changing" class="product-price">{{ number_format($cloth->skus[0]->price, 0, ',', '.') }} VNĐ</div>

            <form class="product-options" method="get" action="{{ route('addToCart', $cloth->id) }}">
                <div class="option-group">
                    <label class="option-label">Kích cỡ:</label>
                    <div class="size-options" id="sizeButtons">
                        @foreach($cloth->skus as $sku)
                            <button 
                                type="button" 
                                class="size-option size-btn {{ $loop->first ? 'active' : '' }}" 
                                data-sku-id="{{ $sku->id }}" 
                                data-quantity="{{ $sku->quantity }}"
                                data-size="{{ $sku->skuValues[0]->optionValue->value }}"
                                data-price="{{$sku->price}}">
                                {{ $sku->skuValues[0]->optionValue->value }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="sku_id" id="selectedSkuId" value="{{ $cloth->skus[0]->id }}">

                <div class="quantity-group">
                    <label class="option-label">Số lượng:</label>
                    <div class="quantity-selector">
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" id="decreaseBtn">−</button>
                            <input id="quantityInput" type="number" name="inputQuantity" min="1" max="{{ $cloth->skus[0]->quantity ?? 999 }}" value="1" class="quantity-input">
                            <button type="button" class="quantity-btn" id="increaseBtn">+</button>
                        </div>
                    </div>
                    <div id="quantityAvailable" class="stock-info">{{ $cloth->skus[0]->quantity }} sản phẩm có sẵn</div>
                </div>

                <button id="cartAdd" type="submit" class="add-to-cart-btn">
                    <i class="bi bi-cart-fill"></i>
                    Thêm vào giỏ
                </button>
            </form>

            <div class="product-description">
                <h3 class="description-title">Mô tả sản phẩm</h3>
                <div class="description-content">
                    {!! nl2br(e($cloth->product_description)) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="slide">
    @foreach($relatedProducts as $product)
        <div class="item">
            <a href="{{ route('showcus', $product->id) }}" class="text-decoration-none">
                <img src="{{ asset('storage/images/' . $product->images[0]->image_url) }}" alt="{{ $product->name }}" class="img-fluid" width="150px">
                <h6 class="mt-2 text-dark">{{ $product->name }}</h6>
                <p class="text-primary fw-bold">{{ number_format($product->skus[0]->price, 0, ',', '.') }}₫</p>
            </a>
        </div>
    @endforeach
</div> -->

<!-- Footer --> 
 <!-- Cai nay @extend ra  -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Kết nối với chúng tôi qua các nền tảng xã hội:</span>
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
        // Image gallery functionality
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentImageIndex = 0;
        
        // Thumbnail gallery navigation
        const thumbnailTrack = document.getElementById('thumbnailTrack');
        const thumbnailPrevBtn = document.getElementById('thumbnailPrevBtn');
        const thumbnailNextBtn = document.getElementById('thumbnailNextBtn');
        let currentThumbnailIndex = 0;
        const thumbnailsPerView = 4;
        const maxThumbnailIndex = Math.max(0, thumbnails.length - thumbnailsPerView);
        
        // Thumbnail click handlers
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', function() {
                currentImageIndex = index;
                updateMainImage();
                updateActiveThumbnail();
            });
        });
        
        // Main image navigation button handlers
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function() {
                currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : thumbnails.length - 1;
                updateMainImage();
                updateActiveThumbnail();
                ensureThumbnailVisible();
            });
            
            nextBtn.addEventListener('click', function() {
                currentImageIndex = currentImageIndex < thumbnails.length - 1 ? currentImageIndex + 1 : 0;
                updateMainImage();
                updateActiveThumbnail();
                ensureThumbnailVisible();
            });
        }
        
        // Thumbnail navigation handlers
        if (thumbnailPrevBtn && thumbnailNextBtn) {
            thumbnailPrevBtn.addEventListener('click', function() {
                if (currentThumbnailIndex > 0) {
                    currentThumbnailIndex--;
                    updateThumbnailPosition();
                    updateThumbnailNavButtons();
                }
            });
            
            thumbnailNextBtn.addEventListener('click', function() {
                if (currentThumbnailIndex < maxThumbnailIndex) {
                    currentThumbnailIndex++;
                    updateThumbnailPosition();
                    updateThumbnailNavButtons();
                }
            });
            
            // Initialize thumbnail navigation buttons
            updateThumbnailNavButtons();
        }
        
        function updateMainImage() {
            if (thumbnails[currentImageIndex]) {
                mainImage.src = thumbnails[currentImageIndex].src;
            }
        }
        
        function updateActiveThumbnail() {
            thumbnails.forEach(thumb => thumb.classList.remove('active'));
            if (thumbnails[currentImageIndex]) {
                thumbnails[currentImageIndex].classList.add('active');
            }
        }
        
        function updateThumbnailPosition() {
            const translateX = -(currentThumbnailIndex * (100 / thumbnailsPerView));
            thumbnailTrack.style.transform = `translateX(${translateX}%)`;
        }
        
        function updateThumbnailNavButtons() {
            if (thumbnailPrevBtn && thumbnailNextBtn) {
                thumbnailPrevBtn.disabled = currentThumbnailIndex === 0;
                thumbnailNextBtn.disabled = currentThumbnailIndex >= maxThumbnailIndex;
            }
        }
        
        function ensureThumbnailVisible() {
            // Make sure the active thumbnail is visible
            if (currentImageIndex < currentThumbnailIndex) {
                currentThumbnailIndex = currentImageIndex;
                updateThumbnailPosition();
                updateThumbnailNavButtons();
            } else if (currentImageIndex >= currentThumbnailIndex + thumbnailsPerView) {
                currentThumbnailIndex = currentImageIndex - thumbnailsPerView + 1;
                updateThumbnailPosition();
                updateThumbnailNavButtons();
            }
        }

        // Size selection and quantity functionality
        const buttons = document.querySelectorAll('.size-btn');
        const quantityInput = document.getElementById('quantityInput');
        const quantityAvailable = document.getElementById('quantityAvailable');
        const selectedSkuId = document.getElementById('selectedSkuId');
        const price = document.getElementById('price_changing');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');

        // Initialize disabled state for out-of-stock items
        buttons.forEach(button => {
            if (button.getAttribute('data-quantity') == 0) {
                button.disabled = true;
                button.classList.add('unavailable');
            }
        });

        // Check stock
        if (quantityInput.max == 0) {
            document.getElementById("cartAdd").disabled = true;
        }

        // Size button click handlers
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Update hidden input
                selectedSkuId.value = this.getAttribute('data-sku-id');

                // Update quantity
                const quantity = this.getAttribute('data-quantity');
                quantityInput.max = quantity;
                quantityInput.value = 1;
                quantityAvailable.textContent = `${quantity} sản phẩm có sẵn`;
                
                // Update cart button state
                if (quantity != 0) {
                    document.getElementById("cartAdd").disabled = false;
                } else {
                    document.getElementById("cartAdd").disabled = true;
                }
                
                // Update price
                const pricing = this.getAttribute('data-price');
                price.innerHTML = Intl.NumberFormat("vi-VN", { 
                    style: "currency", 
                    currency: "VND" 
                }).format(pricing);

                // Highlight selected button
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Quantity control handlers
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.max);
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });

        // Quantity input validation
        quantityInput.addEventListener('input', function() {
            const value = parseInt(this.value);
            const max = parseInt(this.max);
            
            if (value < 1) {
                this.value = 1;
            } else if (value > max) {
                this.value = max;
            }
        });
    });
</script>
</body>
</html>
@endsection('content')