<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
{{--        @extends('admin.layout')--}}
{{--        @section('content')--}}

            <style>
                .push-top {
                    margin-top: 50px;
                }
                .hidden-form {
                    display: None;
                }
            </style>
            <script
                src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>
            <header class="p-3 text-bg-dark">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                        </a>

                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href='{{ route("Cloths.index") }}' ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRunR8mq9MYERvPi5vDff-HHn4kFeJpXEpWO6cg0_Yzg&s" width="70" height="45" alt=""></a></li>
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href='{{ route("Cloths.index") }}' class="nav-link px-2 text-white">Home</a></li>
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href="{{route('order', 'Chờ duyệt đơn')}}" class="btn btn-outline-success">Chờ duyệt đơn</a></li>
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href="{{route('order', 'Đang giao hàng')}}" class="btn btn-outline-warning">Đang vận chuyển</a></li>
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href="{{route('order', 'Đã giao')}}" class="btn btn-outline-success">Đã giao hàng</a></li>
                            <li class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"><a href="{{route('order', 'Đã hủy' )}}" class="btn btn-outline-danger me-2">Đã hủy</a></li>
                        </ul>



                        <div class="d-flex gap-2 align-items-center">

                            <form method="post" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                            </form>

                        </div>
                    </div>
                </div>

            </header>
</head>

<body>



<div class="container-fluid">



    @if($specific != null)
        <h1 id="order-status" class="text-center">{{$specific}}</h1>
        <table class="table-hover table ">
            <tr class="table-primary">

                <td>ID</td>
                <td>Khách hàng</td>
                <td>Địa chỉ</td>
                <td>Số điện thoại</td>
                <td>Trạng thái</td>
                <td colspan="3" class="text-center">ACTION</td>
            </tr>



            <tbody class="">
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->user->address}}</td>
                <td>{{$order->user->phone}}</td>
                <td>{{$order->status}}</td>
                {{--                        Thong tin don hang--}}
                <td class="text-center">
                    <form method="get" action="{{route('order.details',$order->id)}}">
                        <button class="btn btn-outline-success">Thông tin đơn hàng</button>
                    </form>
                </td>



                    @if($specific == 'Chờ duyệt đơn')

                        <td class="text-center">
                            <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                @csrf
                                <input type="hidden" name="status" value='Đang giao hàng'>
                                <button class="btn btn-outline-success">Chấp nhận</button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                @csrf
                                <input type="hidden" name="status" value='Đã hủy'>
                                <button class="btn btn-outline-danger" type="submit">Hủy</button>
                            </form>
                        </td>
                    @elseif($specific == 'Đang giao hàng')
                        <td class="text-center">
                            <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                @csrf
                                <input type="hidden" name="status" value='Đã giao'>
                                <button class="btn btn-outline-success">Hoàn thành</button>
                            </form>
                        </td>



                    @endif
            </tr>
        @endforeach
    @endif
    </tbody>
{{--    <div class="table-footer">--}}
{{--
{{--        <div class="timTheoNgay">--}}
{{--            Từ ngày: <input type="date" id="fromDate">--}}
{{--            Đến ngày: <input type="date" id="toDate">--}}

{{--            <button onclick="locDonHangTheoKhoangNgay()"><i class="fa fa-search"></i> Tìm</button>--}}
{{--        </div>--}}

{{--        <select name="kieuTimDonHang">--}}
{{--            <option value="ma">Tìm theo mã đơn</option>--}}
{{--            <option value="khachhang">Tìm theo tên khách hàng</option>--}}
{{--            <option value="trangThai">Tìm theo trạng thái</option>--}}
{{--        </select>--}}
{{--        <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemDonHang(this)">--}}
    </div>
    </table>

</div>
</body>
<script>

    // function updateOrderStatus(status) {
    //     document.getElementById('order-status').textContent = status;
    // }
    //
    //
    // document.getElementById('btn-cho-duyet-don').addEventListener('click', function() {
    //     updateOrderStatus('Chờ duyệt đơn');
    // });
    //
    // document.getElementById('btn-dang-van-chuyen').addEventListener('click', function() {
    //     updateOrderStatus('Đang vận chuyển');
    // });
</script>

</html>






