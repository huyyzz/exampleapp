<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý đơn hàng - Admin</title>
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .brand-logo {
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.05);
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #e5e7eb !important;
        }

        .status-tabs {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 30px 0;
            box-shadow: var(--card-shadow);
        }

        .status-tab {
            flex: 1;
            margin: 0 5px;
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .status-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .status-tab:hover::before {
            left: 100%;
        }

        .status-tab.pending {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
        }

        .status-tab.shipping {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .status-tab.delivered {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .status-tab.cancelled {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .status-tab:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .orders-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .page-title {
            background: linear-gradient(135deg, #212529, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            margin-bottom: 30px;
            
        }

        .orders-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            font-weight: 600;
            border: none;
            padding: 18px 15px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #e5e7eb;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .table td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
        }

        .status-shipping {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .status-delivered {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            margin: 2px;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-info-custom {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: white;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .logout-btn {
            background: linear-gradient(135deg, #f97316, #ea580c);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #d1d5db;
        }

        @media (max-width: 768px) {
            .status-tabs {
                padding: 15px;
            }
            
            .status-tab {
                margin: 5px 0;
                padding: 12px 15px;
                font-size: 14px;
            }
            
            .orders-container {
                padding: 15px;
            }
            
            .table-responsive {
                font-size: 14px;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @extends('admin.layout')
    @section('content')
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>


    <div class="container-fluid px-4">
        <h1 class="page-title display-4 mt-4">Quản lý đơn hàng</h1>

        <!-- Status Selection Tabs -->
        <div class="status-tabs fade-in">
            <div class="d-flex flex-wrap justify-content-center">
                <a href="{{route('order', 'Chờ duyệt đơn')}}" 
                   class="status-tab pending text-decoration-none">
                    <i class="fas fa-clock me-2"></i>
                    Chờ duyệt đơn
                </a>
                <a href="{{route('order', 'Đang giao hàng')}}" 
                   class="status-tab shipping text-decoration-none">
                    <i class="fas fa-truck me-2"></i>
                    Đang vận chuyển
                </a>
                <a href="{{route('order', 'Đã giao')}}" 
                   class="status-tab delivered text-decoration-none">
                    <i class="fas fa-check-circle me-2"></i>
                    Đã giao hàng
                </a>
                <a href="{{route('order', 'Đã hủy')}}" 
                   class="status-tab cancelled text-decoration-none">
                    <i class="fas fa-times-circle me-2"></i>
                    Đã hủy
                </a>
            </div>
        </div>

        <!-- Orders Table -->
        @if($specific != null)
        <div class="orders-container fade-in">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="h4 mb-0">
                    <i class="fas fa-list-alt me-2"></i>
                    Danh sách: <span class="text-primary">{{$specific}}</span>
                </h2>
                <div class="badge bg-primary fs-6 px-3 py-2">
                    Tổng: {{count($orders)}} đơn hàng
                </div>
            </div>

            @if(count($orders) > 0)
            <div class="table-responsive">
                <table class="table orders-table mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i>ID</th>
                            <th><i class="fas fa-user me-1"></i>Khách hàng</th>
                            <th><i class="fas fa-map-marker-alt me-1"></i>Địa chỉ</th>
                            <th><i class="fas fa-phone me-1"></i>Số điện thoại</th>
                            <th><i class="fas fa-info-circle me-1"></i>Trạng thái</th>
                            <th><i class="fas fa-clock me-1"></i>Cập nhật</th>
                            <th class="text-center"><i class="fas fa-cogs me-1"></i>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="fw-bold">#{{$order->id}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                         style="width: 35px; height: 35px;">
                                        <span class="text-white fw-bold">{{substr($order->user->name, 0, 1)}}</span>
                                    </div>
                                    {{$order->user->name}}
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{$order->user->address}}
                                </small>
                            </td>
                            <td>
                                <a href="tel:{{$order->user->phone}}" class="text-decoration-none">
                                    <i class="fas fa-phone me-1 mr"></i>{{$order->user->phone}}
                                </a>
                            </td>
                            <td>
                                <span class="status-badge 
                                    @if($order->status == 'Chờ duyệt đơn') status-pending
                                    @elseif($order->status == 'Đang giao hàng') status-shipping
                                    @elseif($order->status == 'Đã giao') status-delivered
                                    @else status-cancelled
                                    @endif">
                                    {{$order->status}}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{$order->updated_at}}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <!-- Thông tin đơn hàng -->
                                    <form method="get" action="{{route('order.details',$order->id)}}">
                                        <button class="action-btn btn-info-custom">
                                            <i class="fas fa-info-circle me-1"></i>Chi tiết
                                        </button>
                                    </form>

                                    @if($specific == 'Chờ duyệt đơn')
                                        <!-- Chấp nhận -->
                                        <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                            @csrf
                                            <input type="hidden" name="status" value='Đang giao hàng'>
                                            <button class="action-btn btn-success-custom">
                                                <i class="fas fa-check me-1"></i>Chấp nhận
                                            </button>
                                        </form>
                                        <!-- Hủy -->
                                        <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                            @csrf
                                            <input type="hidden" name="status" value='Đã hủy'>
                                            <button class="action-btn btn-danger-custom" type="submit">
                                                <i class="fas fa-times me-1"></i>Hủy
                                            </button>
                                        </form>
                                    @elseif($specific == 'Đang giao hàng')
                                        <!-- Hoàn thành -->
                                        <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                            @csrf
                                            <input type="hidden" name="status" value='Đã giao'>
                                            <button class="action-btn btn-success-custom">
                                                <i class="fas fa-check-double me-1"></i>Hoàn thành
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Không có đơn hàng nào</h4>
                <p>Hiện tại không có đơn hàng nào với trạng thái "{{$specific}}"</p>
            </div>
            @endif
        </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add smooth transitions and interactions
        $(document).ready(function() {
            // Add loading effect for form submissions
            $('form').on('submit', function() {
                $(this).find('button').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Đang xử lý...');
            });

            // Add hover effects
            $('.status-tab').hover(
                function() {
                    $(this).addClass('shadow-lg');
                },
                function() {
                    $(this).removeClass('shadow-lg');
                }
            );
        });
    </script>
</body>

</html>
@endsection