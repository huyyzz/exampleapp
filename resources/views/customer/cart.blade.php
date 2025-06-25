<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #2d3748;
        }

        .cart-container {
            background-color: #ffffff;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .cart-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .cart-header {
            background: linear-gradient(135deg,rgb(220, 162, 80) 0%,rgb(197, 127, 41) 100%);
            color: white;
            padding: 2rem;
            position: relative;
        }

        .cart-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .clear-cart-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .clear-cart-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .cart-item {
            background: #ffffff;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-price {
            font-size: 1.125rem;
            font-weight: 600;
            color: #4299e1;
            margin-bottom: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .quantity-input {
            width: 80px;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .quantity-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .remove-btn {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .remove-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(229, 62, 62, 0.3);
            color: white;
            text-decoration: none;
        }

        .subtotal {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            text-align: right;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-summary {
            background: #f7fafc;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
            border: 1px solid #e2e8f0;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            text-align: center;
            margin-bottom: 1.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .payment-select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
        }

        .payment-select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .checkout-btn {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(72, 187, 120, 0.3);
            color: white;
            text-decoration: none;
        }

        .continue-shopping-btn {
            background: white;
            color: #4299e1;
            border: 2px solid #4299e1;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin-right: 1rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .continue-shopping-btn:hover {
            background: #4299e1;
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .customer-info {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .customer-info h5 {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: #f7fafc;
            border-radius: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .info-icon {
            color: #4299e1;
            width: 20px;
            height: 20px;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #718096;
            font-size: 1.25rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .empty-cart i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #cbd5e0;
        }

        .customer-name-input {
            background: transparent;
            border: none;
            font-weight: 600;
            color: #2d3748;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .customer-name-input:focus {
            outline: none;
            background: white;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        /* Notification Toast - Updated */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: linear-gradient(135deg, #68d391 0%, #48bb78 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-width: 320px;
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 4px solid #38a169;
        }

        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast.hide {
            transform: translateX(400px);
            opacity: 0;
        }

        .toast-icon {
            font-size: 1.25rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-message {
            flex: 1;
            font-size: 1rem;
            font-weight: 600;
        }

        /* Custom confirmation dialog */
        .confirmation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .confirmation-dialog {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .confirmation-overlay.show .confirmation-dialog {
            transform: scale(1);
            opacity: 1;
        }

        .confirmation-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .confirmation-message {
            color: #4a5568;
            margin-bottom: 2rem;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .confirmation-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .confirm-btn {
            background: #e53e3e;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .confirm-btn:hover {
            background: #c53030;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #4a5568;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cancel-btn:hover {
            background: #cbd5e0;
        }

        @media (max-width: 768px) {
            .cart-container {
                padding: 1rem;
            }
            
            .cart-header {
                padding: 1.5rem;
            }
            
            .cart-title {
                font-size: 2rem;
            }
            
            .cart-item {
                padding: 1rem;
            }
            
            .product-image {
                width: 100px;
                height: 100px;
            }
            
            .total-amount {
                font-size: 1.5rem;
            }

            .toast {
                min-width: 280px;
                margin: 0 10px;
            }

            .confirmation-dialog {
                margin: 0 20px;
            }
        }
    </style>
</head>

<body>
@extends('customer.layout')
@section('content')
    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Custom Confirmation Dialog -->
    <div class="confirmation-overlay" id="confirmationOverlay">
        <div class="confirmation-dialog">
            <h3 class="confirmation-title">Xác nhận xóa</h3>
            <p class="confirmation-message">Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?</p>
            <div class="confirmation-buttons">
                <button class="confirm-btn" id="confirmDelete">
                    <i class="fas fa-trash mr-2"></i>
                    Xóa
                </button>
                <button class="cancel-btn" id="cancelDelete">
                    <i class="fas fa-times mr-2"></i>
                    Hủy
                </button>
            </div>
        </div>
    </div>

    <div class="cart-container">
        <div class="container mx-auto max-w-7xl">
            <div class="cart-card">
                <!-- Cart Header -->
                <div class="cart-header">
                    <div class="flex justify-between items-center">
                        <h1 class="cart-title">
                            <i class="fas fa-shopping-cart mr-4"></i>
                            Giỏ hàng của bạn
                        </h1>
                        <a href="{{ url('clear-cart') }}" class="clear-cart-btn">
                            <i class="fas fa-trash mr-2"></i>
                            Xóa tất cả
                        </a>
                    </div>
                </div>

                <!-- Cart Content -->
                <div class="p-6">
                    <form method="post" action="{{route('checkOut')}}">
                        @csrf
                        
                        <?php
                        $total = 0;
                        $index = 0;
                        ?>

                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <?php
                                $total += $details['price'] * $details['quantity'];
                                $index += 1;
                                ?>

                                <div class="cart-item">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                        <!-- Product Image -->
                                        <div class="md:col-span-2">
                                            <img src='{{asset("storage/images/". $details["image"]) }}' 
                                                 alt="{{ $details['name'] }}" 
                                                 class="product-image w-full h-auto object-cover">
                                        </div>

                                        <!-- Product Info -->
                                        <div class="md:col-span-4">
                                            <h3 class="product-name">{{ $details['name'] }}</h3>
                                            <p class="product-price">Giá tiền: {{ number_format($details['price'], 0, ',', '.') }} VNĐ</p>
                                            <p>Sản phẩm có sẵn: {{ $details['QuantityInWareHouse'] }}</p>
                                            <button type="button" class="remove-btn remove-from-cart" data-id="{{ $id }}" data-name="{{ $details['name'] }}">
                                                <i class="fas fa-trash"></i>
                                                Xóa
                                            </button>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Số lượng:</label>
                                            <input name="data[{{$index}}][quantity]" 
                                                   type="number" 
                                                   min="1" 
                                                   max="{{$details['QuantityInWareHouse']}}" 
                                                   value="{{$details['quantity']}}" 
                                                   class="quantity-input quantity">
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="md:col-span-2">
                                            <div class="subtotal" data-th="Subtotal"></div>
                                        </div>

                                        <!-- Hidden Fields -->
                                        <input name="data[{{$index}}][id]" type="hidden" value="{{$details['id']}}">
                                        <div style="display: none" data-th="Price">{{$details['price']}}</div>
                                        <div style="display: none" data-th="Id">{{$details['id']}}</div>
                                        <div style="display: none" data-th="QuantityInWareHouse">{{$details['QuantityInWareHouse']}}</div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Cart Summary -->
                            <div class="cart-summary">
                                <div class="total-amount">
                                    <span>Tổng cộng: </span>
                                    <span id="total" data-td="total"></span>
                                </div>

                                <!-- Payment Method -->
                                <div class="mb-6">
                                    <label for="payment_type" class="block text-lg font-semibold text-gray-700 mb-3">
                                        Phương thức thanh toán:
                                    </label>
                                    <select class="payment-select" id="payment_type" name="payment_type" required>
                                        <option value="COD">Thanh toán khi nhận hàng (COD)</option>
                                        <option value="VNPAY">VNPay</option>
                                    </select>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('customer.home') }}" class="continue-shopping-btn">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Tiếp tục mua hàng
                                    </a>
                                    <a onclick="this.closest('form').submit();return false;" 
                                       href="#" 
                                       class="checkout-btn flex-1">
                                        <i class="fas fa-credit-card mr-2"></i>
                                        Đặt hàng ngay
                                    </a>
                                </div>
                            </div>

                        @else
                            <div class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <h3>Giỏ hàng trống</h3>
                                <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                                <a href="{{ route('customer.home') }}" class="continue-shopping-btn mt-4">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Bắt đầu mua sắm
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Customer Information -->
            @if(!empty($details))
                <div class="customer-info">
                    <h5>
                        <i class="fas fa-user-circle mr-2"></i>
                        Thông tin khách hàng
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="info-item">
                            <i class="fas fa-user info-icon"></i>
                            <div>
                                <strong>Tên khách hàng:</strong>
                                <input type="text" value="{{$user->name}}" class="customer-name-input ml-2">
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope info-icon"></i>
                            <span><strong>Email:</strong> {{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone info-icon"></i>
                            <span><strong>Điện thoại:</strong> {{ $user->phone }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar info-icon"></i>
                            <span><strong>Khách hàng từ:</strong> {{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item md:col-span-2">
                            <i class="fas fa-map-marker-alt info-icon"></i>
                            <span><strong>Địa chỉ:</strong> {{ $user->address }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
</body>
@section('scripts')
    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });

        var quantityInputs = document.querySelectorAll('.quantity');
        var total = 0;
        
        quantityInputs.forEach(function(quantityInput) {
            //init
            var Quantity = parseInt(quantityInput.value);
            var QuantityInWareHouse = parseInt(quantityInput.closest('.cart-item').querySelector('[data-th="QuantityInWareHouse"]').innerHTML.trim());
            var price = parseFloat(quantityInput.closest('.cart-item').querySelector('[data-th="Price"]').innerHTML.trim());
            var Subtotal = price * Quantity;
            var formattedSubtotal = formatter.format(price * Quantity);

            quantityInput.closest('.cart-item').querySelector('[data-th="Subtotal"]').innerHTML = formattedSubtotal;
            total = total + Subtotal;
            document.getElementById('total').innerHTML = formatter.format(total);

            var productId = parseInt(quantityInput.closest('.cart-item').querySelector('[data-th="Id"]').innerHTML.trim());
            
            quantityInput.addEventListener('change', function() {
                price = parseFloat(quantityInput.closest('.cart-item').querySelector('[data-th="Price"]').innerHTML.trim());
                var oldPrice = Quantity * price;

                productId = parseInt(quantityInput.closest('.cart-item').querySelector('[data-th="Id"]').innerHTML.trim());
                Quantity = parseInt(quantityInput.value);
                
                if (Quantity >= QuantityInWareHouse + 1) {
                    Quantity = QuantityInWareHouse;
                    quantityInput.value = QuantityInWareHouse;
                }
                
                Subtotal = price * Quantity;
                formattedSubtotal = formatter.format(price * Quantity);
                priceChange = Quantity * price - oldPrice;

                quantityInput.closest('.cart-item').querySelector('[data-th="Subtotal"]').innerHTML = formattedSubtotal;
                total = total + priceChange;
                document.getElementById('total').innerHTML = formatter.format(total);

                localStorage.setItem('quantity' + productId, Quantity);
            });
        });

        // Enhanced Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            toast.innerHTML = `
                <div class="toast-icon">
                    <i class="fas ${icon}"></i>
                </div>
                <span class="toast-message">${message}</span>
            `;
            
            toastContainer.appendChild(toast);
            
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 200);
            
            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => {
                    if (toastContainer.contains(toast)) {
                        toastContainer.removeChild(toast);
                    }
                }, 400);
            }, 3000);
        }

        // Custom confirmation dialog
        function showConfirmDialog(message, onConfirm) {
            const overlay = document.getElementById('confirmationOverlay');
            const confirmBtn = document.getElementById('confirmDelete');
            const cancelBtn = document.getElementById('cancelDelete');
            
            overlay.style.display = 'flex';
            setTimeout(() => {
                overlay.classList.add('show');
            }, 10);
            
            // Remove existing event listeners
            const newConfirmBtn = confirmBtn.cloneNode(true);
            const newCancelBtn = cancelBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
            cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
            
            // Add new event listeners
            newConfirmBtn.addEventListener('click', function() {
                hideConfirmDialog();
                onConfirm();
            });
            
            newCancelBtn.addEventListener('click', hideConfirmDialog);
            
            // Close on overlay click
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    hideConfirmDialog();
                }
            });
        }

        function hideConfirmDialog() {
            const overlay = document.getElementById('confirmationOverlay');
            overlay.classList.remove('show');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 300);
        }

        // Updated remove from cart functionality
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            var productName = ele.attr("data-name");

            showConfirmDialog("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?", function() {
                $.ajax({
                    url: '{{ url("remove-from-cart") }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id")
                    },
                    success: function(response) {
                        showToast("Xóa khỏi giỏ hàng thành công!", "success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function() {
                        showToast("Có lỗi xảy ra. Vui lòng thử lại!", "error");
                    }
                });
            });
        });
    </script>
@endsection

</html>