@extends('customer.layout')
@section('content')

<style>
    /* General Styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }
    
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    /* Banner Slider Styles */
    #Slider {
        position: relative;
        margin-bottom: 60px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .slider-container {
        position: relative;
        height: 500px;
        overflow: hidden;
    }

    .aspect-ratio-169 {
        position: relative;
        height: 500px;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
    }

    .aspect-ratio-169 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        transition: opacity 0.8s ease-in-out;
    }

    .slider-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.1) 100%);
        z-index: 1;
    }

    .slider-content {
        position: absolute;
        top: 50%;
        left: 50px;
        transform: translateY(-50%);
        z-index: 2;
        color: white;
        max-width: 500px;
    }

    .slider-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .slider-subtitle {
        font-size: 1.2rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        line-height: 1.6;
    }

    .dot-container {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 15px;
        z-index: 3;
    }

    .dot {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .dot.active {
        background: #ff6b6b;
        transform: scale(1.2);
        border-color: white;
        box-shadow: 0 0 20px rgba(255, 107, 107, 0.6);
    }

    .dot:hover {
        background: rgba(255,255,255,0.8);
        transform: scale(1.1);
    }

    /* Section Headers */
    .section-header {
        text-align: center;
        margin: 60px 0 40px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(45deg,rgb(0, 0, 0) 0%,rgb(103, 100, 100) 100%);
-webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /*2tab trên sp*/
    .tab {
            font-size: 1.2rem;
            color: #666;
            text-decoration: none;
            padding-bottom: 10px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
            margin: 0 15px;
    }

    .tab.active {
            color: #333;    
            border-bottom-color: #333;
            font-weight: bold;
    }

    /* Product Grid Styles */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 25px;
        margin-bottom: 60px;
    }

    @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Product Card Styles */
    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .product-image-container {
        position: relative;
        padding-top: 120%;
        overflow: hidden;
        background: #f8f9fa;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 140px;
        justify-content: space-between;
    }

    .product-name {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .add-to-cart-btn {
background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 15px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(45deg, #ee5a52, #ff6b6b);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
    }

    /* Summer Sale Section */
    .summer-sale-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 25px;
        padding: 60px 40px;
        text-align: center;
        margin: 80px 0 60px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .summer-sale-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
        animation: float 20s linear infinite;
    }

    @keyframes float {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .sale-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        position: relative;
        z-index: 1;
    }

    .sale-subtitle {
        font-size: 1.3rem;
        margin-bottom: 30px;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .discount-badge {
        display: inline-block;
        background: #ff6b6b;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        position: relative;
        z-index: 1;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Alert Styles */
    .hidden2 {
        opacity: 1;
        transition: opacity 1.2s ease-in-out;
        background: linear-gradient(45deg, #00b894, #00cec9);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 15px 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 184, 148, 0.3);
    }

    .hidden2.fade {
        opacity: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .slider-title {
            font-size: 2.5rem;
        }
        
        .slider-content {
            left: 30px;
            max-width: 300px;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .sale-title {
            font-size: 2.2rem;
}
        
        .summer-sale-section {
            padding: 40px 20px;
        }
    }
</style>

<!-- Banner Slider Section -->
<section id="Slider">
    <div class="slider-container">
        <div class="slider-overlay"></div>
        <div class="slider-content">
        </div>
        <div class="aspect-ratio-169">
            <img src="https://cotton4u.vn/files/news/2025/06/13/8d5d7812b3858c859b88c63383ce65bd.webp" alt="Slide 1">
            <img src="https://cotton4u.vn/files/news/2025/04/23/0cd827900f8d75840487982c44506798.webp" alt="Slide 2">
            <img src="https://cotton4u.vn/files/news/2025/05/15/7632553893f40eb4ddd8a5010cc94843.webp" alt="Slide 3">
            <img src="https://cotton4u.vn/files/news/2025/06/09/bd4035a3c5af805739dc1055cf4a15ec.webp" alt="Slide 4">
            <img src="https://cotton4u.vn/files/news/2025/06/03/1709a21e8e1c7b0f2fdc03f43c3471b0.webp" alt="Slide 5">
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Success Alert -->
    @if(session()->has('success'))
        <div class="alert hidden2">
            {{ session()->get('success') }}
        </div>
    @endif

    <!-- New Arrivals Section -->
     <section class="section-header">
        <h2 class="section-title">NEW ARRIVAL</h2>
        <div class="section-tabs">
            <!-- <a href="#" class="tab active">Lady</a>
            <a href="#" class="tab">Metagent</a> -->
        </div>
    </section>

    <div class="products-grid">
        @if ($specific != null)
            @foreach($specific as $item)
                <div class="product-card">
                    <div class="product-image-container">
                        <a href="{{ route('showcus', $item->id) }}">
                            <img src="{{ asset('storage/images/' . $item->images[0]->image_url) }}" alt="{{ $item->product_name }}" class="product-image">
                        </a>
                        <span class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px; font-size: 0.75rem; padding: 5px 8px; border-radius: 15px;">NEW</span>
                    </div>
                    <div class="product-info">
                        <h5 class="product-name">{{ \Illuminate\Support\Str::limit($item->product_name, 50) }}</h5>
                        <div class="product-footer">
                            <span class="product-price">{{ number_format($item->product_price, 0) }}đ</span>
                            <form method="get" action="{{ route('addToCart', $item->id) }}">
                                <button class="add-to-cart-btn" type="submit">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
</form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach($cloths->take(5) as $item)
                <div class="product-card">
                    <div class="product-image-container">
                        <a href="{{ route('showcus', $item->id) }}">
                            <img src="{{ asset('storage/images/' . $item->images[0]->image_url) }}" alt="{{ $item->product_name }}" class="product-image">
                        </a>
                        <span class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px; font-size: 0.75rem; padding: 5px 8px; border-radius: 15px;">NEW</span>
                    </div>
                    <div class="product-info">
                        <h5 class="product-name">{{ \Illuminate\Support\Str::limit($item->product_name, 50) }}</h5>
                        <div class="product-footer">
                            <span class="product-price">{{ number_format($item->product_price, 0) }}đ</span>
                            <form method="get" action="{{ route('addToCart', $item->id) }}">
                                <input type="hidden" value="1" name="inputQuantity" id="inputQuantity" min="1" max="999">
                                <button class="add-to-cart-btn" type="submit">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Summer Sale Section -->
    <section class="summer-sale-section">
        <h2 class="sale-title">ƯU ĐÃI CHÀO HÈ</h2>
        <p class="sale-subtitle">Online Exclusive - Giảm giá lên đến 70% cho tất cả sản phẩm</p>
        <div class="discount-badge">GIẢM TỚI 70%</div>
    </section>

    <!-- Best Sellers Section -->
    <div class="section-header">
        <h2 class="section-title">BEST SELLERS</h2>
        <!-- <p class="section-subtitle">Ưu đãi cực sốc</p> -->
         <div class="products-grid">
         @foreach($productBestSeller as $item)
                <div class="product-card">
                    <div class="product-image-container">
                        <a href="{{ route('showcus', $item->id) }}">
                            <img src="{{ asset('storage/images/' . $item->images[0]->image_url) }}" alt="{{ $item->product_name }}" class="product-image">
                        </a>
                        <span class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px; font-size: 0.75rem; padding: 5px 8px; border-radius: 15px;">NEW</span>
                    </div>
                    <div class="product-info">
                        <h5 class="product-name" style="text-align: left;">{{ \Illuminate\Support\Str::limit($item->product_name, 50) }}</h5>
<div class="product-footer">
                            <span class="product-price">{{ number_format($item->product_price, 0) }}đ</span>
                            <form method="get" action="{{ route('addToCart', $item->id) }}">
                                <input type="hidden" value="1" name="inputQuantity" id="inputQuantity" min="1" max="999">
                                <button class="add-to-cart-btn" type="submit">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

    </div>

    
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

<script>
    // Alert fade out functionality
    window.addEventListener('load', () => {
        if (document.querySelector('.hidden2') !== null) {
            const div = document.querySelector('.hidden2');
            setTimeout(() => {
                div.classList.add('fade');
div.addEventListener('transitionend', () => {
                    div.remove();
                });
            }, 3000);
        }
    });

    // Enhanced Slider functionality
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
    const imgContainer = document.querySelector('.aspect-ratio-169');
    const dotItem = document.querySelectorAll(".dot");
    let index = 0;
    let imgNumber = imgPosition.length;
    let isAutoPlaying = true;
    let slideInterval;

    // Initialize slider
    imgPosition.forEach(function(image, idx) {
        image.style.left = idx * 100 + "%";
        image.style.opacity = idx === 0 ? "1" : "0";
        
        dotItem[idx].addEventListener("click", function() {
            slider(idx);
            resetAutoPlay();
        });
    });

    function imgSlide() {
        if (!isAutoPlaying) return;
        index++;
        if (index >= imgNumber) {
            index = 0;
        }
        slider(index);
    }

    function slider(newIndex) {
        // Fade out current image
        imgPosition[index].style.opacity = "0";
        
        // Update index
        index = newIndex;
        
        // Fade in new image
        setTimeout(() => {
            imgPosition[index].style.opacity = "1";
        }, 100);
        
        // Update dots
        const dotActive = document.querySelector(".dot.active");
        dotActive.classList.remove("active");
        dotItem[index].classList.add("active");
        
        // Move container
        imgContainer.style.transform = "translateX(-" + index * 100 + "%)";
    }

    function resetAutoPlay() {
        isAutoPlaying = false;
        clearInterval(slideInterval);
        setTimeout(() => {
            isAutoPlaying = true;
            slideInterval = setInterval(imgSlide, 5000);
        }, 10000); // Resume auto play after 10 seconds
    }

    // Start auto play
    slideInterval = setInterval(imgSlide, 5000);

    // Pause on hover
    const sliderElement = document.getElementById('Slider');
    sliderElement.addEventListener('mouseenter', () => {
        isAutoPlaying = false;
    });
    
    sliderElement.addEventListener('mouseleave', () => {
        isAutoPlaying = true;
    });
</script>

@endsection