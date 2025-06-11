<link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .product-detail-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 20px;
    }
    
    .product-detail-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }
    
    .back-link {
        color: #667eea !important;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        background: rgba(102, 126, 234, 0.1);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .back-link:hover {
        background: rgba(102, 126, 234, 0.2);
        transform: translateX(-3px);
        color: #5a67d8 !important;
    }
    
    .product-image-section {
        padding: 30px;
        background: linear-gradient(145deg, #f8f9ff 0%, #ffffff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
    }
    
    .product-image-container {
        position: relative;
        width: 100%;
        max-width: 400px;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .product-image:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .product-info-section {
        padding: 40px;
        background: white;
    }
    
    .product-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }
    
    .product-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
    }
    
    .product-info-item {
        background: linear-gradient(145deg, #f8f9ff 0%, #ffffff 100%);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid transparent;
        border-image: linear-gradient(135deg, #667eea, #764ba2) 1;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .product-info-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    
    .product-info-item:hover {
        transform: translateX(3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .info-label {
        font-weight: 600;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        font-size: 1rem;
    }
    
    .info-value {
        color: #2d3748;
        font-size: 1.1rem;
        line-height: 1.6;
        padding-left: 30px;
    }
    
    .price-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: #e53e3e;
        text-shadow: 0 2px 4px rgba(229, 62, 62, 0.2);
    }
    
    .description-text {
        text-align: justify;
        line-height: 1.7;
    }
    
    .info-icon {
        width: 20px;
        text-align: center;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .product-detail-section {
            padding: 15px;
        }
        
        .product-image-section,
        .product-info-section {
            padding: 20px;
        }
        
        .product-title {
            font-size: 1.6rem;
        }
        
        .product-image {
            height: 300px;
        }
        
        .product-image-section {
            min-height: 350px;
        }
        
        .info-value {
            padding-left: 25px;
        }
        
        .price-value {
            font-size: 1.4rem;
        }
    }
    
    @media (max-width: 576px) {
        .product-info-section {
            padding: 25px 20px;
        }
        
        .product-title {
            font-size: 1.4rem;
        }
        
        .product-image {
            height: 250px;
        }
        
        .product-image-section {
            min-height: 300px;
            padding: 20px 15px;
        }
    }
    
    /* Animations */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .product-info-item {
        animation: fadeIn 0.6s ease-out;
    }
    
    .product-info-item:nth-child(1) { animation-delay: 0.1s; }
    .product-info-item:nth-child(2) { animation-delay: 0.2s; }
    .product-info-item:nth-child(3) { animation-delay: 0.3s; }
    .product-info-item:nth-child(4) { animation-delay: 0.4s; }
    
    /* Loading shimmer effect */
    .shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }
    
    /* Image placeholder styling */
    .image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #6c757d;
        font-size: 1rem;
        border-radius: 15px;
    }
</style>

@extends('admin.layout')
@section('content')
<section class="product-detail-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href='{{ route('Cloths.index') }}' class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Quay lại danh sách
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="product-detail-container">
                    <div class="row g-0">
                        <!-- Hình ảnh sản phẩm - Bên trái -->
                        <div class="col-lg-6 col-md-12">
                            <div class="product-image-section">
                                <div class="product-image-container">
                                    <img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" 
                                         alt="Product Image" 
                                         class="product-image"
                                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'400\' viewBox=\'0 0 400 400\'%3E%3Crect width=\'400\' height=\'400\' fill=\'%23f8f9fa\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' fill=\'%236c757d\' font-size=\'16\'%3EKhông có hình ảnh%3C/text%3E%3C/svg%3E">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Chi tiết sản phẩm - Bên phải -->
                        <div class="col-lg-6 col-md-12">
                            <div class="product-info-section">
                                <h2 class="product-title">{{ $cloth->product_name }}</h2>
                                
                                <div class="product-info-item">
                                    <div class="info-label">
                                        <i class="fas fa-align-left text-primary info-icon"></i>
                                        Mô tả sản phẩm
                                    </div>
                                    <div class="info-value description-text">
                                        {{ $cloth->product_description ?: 'Chưa có mô tả chi tiết cho sản phẩm này.' }}
                                    </div>
                                </div>
                                
                                <div class="product-info-item">
                                    <div class="info-label">
                                        <i class="fas fa-tag text-success info-icon"></i>
                                        Giá bán
                                    </div>
                                    <div class="info-value price-value">
                                        {{ number_format($cloth->product_price, 0, ',', '.') }} VNĐ
                                    </div>
                                </div>
                                
                                @if(isset($cloth->QuantityInWareHouse))
                                <div class="product-info-item">
                                    <div class="info-label">
                                        <i class="fas fa-boxes text-warning info-icon"></i>
                                        Số lượng trong kho
                                    </div>
                                    <div class="info-value">
                                        {{ $cloth->QuantityInWareHouse }} sản phẩm
                                    </div>
                                </div>
                                @endif
                                
                                @if(isset($cloth->brand))
                                <div class="product-info-item">
                                    <div class="info-label">
                                        <i class="fas fa-copyright text-info info-icon"></i>
                                        Thương hiệu
                                    </div>
                                    <div class="info-value">
                                        {{ $cloth->brand->name ?? 'Không xác định' }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection