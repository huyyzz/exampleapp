<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Thông Tin Đơn Hàng</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <style>
        body {
            background: #ffffff;
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            color: #000000;
        }

        .main-section {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .order-header {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .order-header h1 {
            color: #000000;
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
        }

        .order-header p {
            color: #666666;
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
        }

        .order-table {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            overflow: hidden;
        }

        .table {
            margin: 0;
            border-collapse: collapse;
            width: 100%;
        }

        .table thead tr {
            background: #f8f9fa;
            border-bottom: 2px solid #e5e5e5;
        }

        .table thead td {
            color: #000000;
            font-weight: 600;
            padding: 1rem;
            border: none;
            font-size: 0.95rem;
        }

        .table tbody tr {
            background: #ffffff;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border: none;
            color: #000000;
            font-size: 0.95rem;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e5e5e5;
        }

        .product-name {
            font-weight: 500;
            color: #000000;
        }

        .product-size {
            color: #000000;
            font-weight: normal;
        }

        .product-quantity {
            color: #000000;
            font-weight: 500;
        }

        .product-price {
            font-weight: 500;
            color: #000000;
        }

        .table tfoot {
            background: #f8f9fa;
            border-top: 2px solid #e5e5e5;
        }

        .table tfoot td {
            color: #000000;
            font-weight: 600;
            padding: 1.5rem 1rem;
            font-size: 1.1rem;
            border: none;
        }

        .total-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: #000000;
        }

        .float-end {
            float: right;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-section {
                padding: 1rem;
            }

            .order-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .order-header h1 {
                font-size: 1.8rem;
            }

            .order-table {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }

            .table thead td,
            .table tbody td,
            .table tfoot td {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            .product-image {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 480px) {
            .order-header h1 {
                font-size: 1.6rem;
            }

            .table thead td,
            .table tbody td,
            .table tfoot td {
                padding: 0.5rem;
                font-size: 0.85rem;
            }

            .product-image {
                width: 50px;
                height: 50px;
            }
        }

        /* Legacy classes for compatibility */
        .products {
            margin-top: 20px;
        }

        .caption {
            text-align: center;
        }

        .img-size {
            width: 225px !important;
            height: 153px;
            margin-left: 20px;
            margin-top: 10px;
        }

        .cart-delete {
            margin-left: 5px;
            text-decoration: none;
            color: grey;
            font-size: 16px;
            margin-top: 5px;
            cursor: pointer;
        }

        .cart-delete:hover {
            color: red;
        }

        .check-btn {
            float: right;
        }

        .shopping-btn {
            background: #fcfcfc;
            border: 1px solid #7c7e81 !important;
        }

        .cart-icon {
            color: black;
            text-decoration: none;
        }

        .cart-icon:hover {
            text-decoration: none;
            color: red;
        }
    </style>
</head>

<body>
@extends('customer.layout')
@section('content')
    <div class="row" style>
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="order-header">
                <h1>Thông Tin Đơn Hàng</h1>
                <p>Chi tiết sản phẩm trong đơn hàng của bạn</p>
            </div>
            
            <div class="order-table dropdown">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td>Kích cỡ</td>
                            <td>Số lượng</td>
                            <td>Hình ảnh</td>
                            <td>Giá sản phẩm</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="product-name">{{$item->product_name}}</td>
                            <td class="product-size">{{$item->size}}</td>
                            <td class="product-quantity">{{$item->quantity}}</td>
                            <td width="120px">
                                <img src="{{asset('storage/images/'.$item->product_image_url)}}" 
                                     class="product-image" 
                                     alt="{{$item->product_name}}">
                            </td>
                            <td class="product-price">{{number_format($item->product_price,0)}} VNĐ</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <td colspan="5">
                            Tổng giá trị đơn hàng
                            <span class="float-end total-amount">{{number_format($order->sub_total,0)}} VNĐ</span>
                        </td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
</body>
</html>