<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Original styles preserved */
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

        /* Simple enhanced styles */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .main-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1200px;
        }

        .cart-table {
            margin-top: 1rem;
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .table thead th {
            background-color: #495057;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 1rem;
            border: none;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-weight: 400;
            color: #495057;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Simple status badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-approved {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .status-delivered {
            background-color: #cff4fc;
            color: #055160;
            border: 1px solid #b6effb;
        }

        /* Simple button styling */
        .btn {
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            border: 1px solid;
        }

        .btn-outline-success {
            color: #198754;
            border-color: #198754;
            background-color: white;
        }

        .btn-outline-success:hover {
            background-color: #198754;
            border-color: #198754;
            color: white;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
            background-color: white;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        /* Simple order ID styling */
        .order-id {
            font-weight: 600;
            color: #495057;
            font-size: 1rem;
        }

        /* Simple datetime styling */
        .order-date {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Clean page title */
        .page-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #495057;
            font-weight: 600;
            font-size: 1.8rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #adb5bd;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .main-section {
                margin: 1rem;
                padding: 1rem;
                border-radius: 6px;
            }

            .table thead th {
                padding: 0.75rem 0.5rem;
                font-size: 0.8rem;
            }

            .table tbody td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }

            .btn {
                padding: 6px 12px;
                font-size: 0.8rem;
            }

            .status-badge {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }

        /* Simple loading state */
        .btn-loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* No action text */
        .no-action {
            color: #6c757d;
            font-style: italic;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
@extends('customer.layout')
@section('content')
    <div class="container-fluid">
        <h1 class="page-title">
            Lịch sử đơn hàng
        </h1>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 main-section">
                <div class="cart-table">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trạng thái</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Chi tiết đơn hàng</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <span class="order-id">#{{$order->id}}</span>
                                </td>

                                <td>
                                    <span class="status-badge 
                                        @if($order->status == 'Chờ duyệt đơn') status-pending
                                        @elseif($order->status == 'Đã duyệt') status-approved
                                        @elseif($order->status == 'Đã hủy') status-cancelled
                                        @elseif($order->status == 'Đã giao hàng') status-delivered
                                        @endif">
                                        {{$order->status}}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-date">
                                        {{$order->updated_at}}
                                    </span>
                                </td>

                                <td>
                                    <form method="get" action="{{route('order.details',$order->id)}}">
                                        <button class="btn btn-outline-success" type="submit">
                                            Xem chi tiết
                                        </button>
                                    </form>
                                </td>

                                @if ($order->status == "Chờ duyệt đơn")
                                    <td>
                                        <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                            @csrf
                                            <input type="hidden" name="status" value='Đã hủy'>
                                            <button class="btn btn-outline-danger" type="submit" 
                                                    onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                Hủy đơn hàng
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-shopping-cart"></i>
                                        <h5>Chưa có đơn hàng nào</h5>
                                        <p>Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple loading state for buttons
        document.querySelectorAll('button[type="submit"]').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('btn-loading');
                this.disabled = true;
            });
        });

        // Confirmation for cancel button
        document.querySelectorAll('.btn-outline-danger').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
                    e.preventDefault();
                    this.classList.remove('btn-loading');
                    this.disabled = false;
                }
            });
        });
    </script>
@endsection
</body>
</html>