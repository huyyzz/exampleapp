<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px 0;
        }

        .push-top {
            margin-top: 20px;
        }

        /* Success Alert Styling */
        .alert-success {
            background: linear-gradient(45deg, #00b894, #00cec9);
            border: none;
            color: white;
            border-radius: 15px;
            padding: 15px 25px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 184, 148, 0.3);
            font-weight: 500;
        }

        /* Table Container */
        .table {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }

        /* Table Header */
        .table-primary {
            background: linear-gradient(deg,rgb(15, 15, 15), #764ba2) !important;
        }

        .table-primary td {
            color: black !important;
            padding: 20px 15px;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none !important;
            position: relative;
        }

        /* Table Body */
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table tbody tr:hover {
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            padding: 20px 15px !important;
            vertical-align: middle;
            border: none !important;
            color: #2c3e50;
            font-weight: 500;
            background-color: transparent !important;
        }

        /* Product Image Styling */
        .table tbody td img {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
            object-fit: cover;
        }

        .table tbody td img:hover {
            transform: scale(1.05);
        }

        /* Button Container */
        .btnContainer {
            background: transparent !important;
            padding: 10px;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 140px;
        }

        /* Button Styling */
        .blockBtn {
            width: 100% !important;
            padding: 10px 15px !important;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 0 !important;
        }

        .btn-primary.blockBtn {
            background: linear-gradient(45deg, #74b9ff, #0984e3) !important;
            color: white !important;
            box-shadow: 0 8px 20px rgba(116, 185, 255, 0.4);
        }

        .btn-primary.blockBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(116, 185, 255, 0.6);
        }

        .btn-primary.blockBtn::before {
            content: '\f044';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .btn-danger.blockBtn {
            background: linear-gradient(45deg, #fd79a8, #e84393) !important;
            color: white !important;
            box-shadow: 0 8px 20px rgba(253, 121, 168, 0.4);
        }

        .btn-danger.blockBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(253, 121, 168, 0.6);
        }

        .btn-danger.blockBtn::before {
            content: '\f2ed';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        /* Details Button (assuming it's the second primary button) */
        .btnContainer form:nth-child(2) .btn-primary.blockBtn {
            background: linear-gradient(45deg, #00cec9, #00b894) !important;
            box-shadow: 0 8px 20px rgba(0, 206, 201, 0.4);
        }

        .btnContainer form:nth-child(2) .btn-primary.blockBtn:hover {
            box-shadow: 0 12px 25px rgba(0, 206, 201, 0.6);
        }

        .btnContainer form:nth-child(2) .btn-primary.blockBtn::before {
            content: '\f06e';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        /* Create Button */
        .btn-warning.btn-lg {
            background: linear-gradient(45deg, #fdcb6e, #e17055) !important;
            border: none !important;
            color: white !important;
            padding: 15px 30px !important;
            border-radius: 50px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 15px 35px rgba(253, 203, 110, 0.4) !important;
        }

        .btn-warning.btn-lg:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 20px 40px rgba(253, 203, 110, 0.6) !important;
            color: white !important;
        }

        .btn-warning.btn-lg::before {
            content: '\f067';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 10px;
        }

        /* Table Data Enhancements */
        .table tbody td:first-child {
            font-weight: 700;
            color: #667eea;
            font-size: 1.1rem;
        }

        .table tbody td:nth-child(2) {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.05rem;
        }

        .table tbody td:nth-child(3) {
            color: #7f8c8d;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table tbody td:nth-child(4) {
            font-weight: 700;
            color: #00b894;
            font-size: 1.1rem;
        }

        .table tbody td:nth-child(5) {
            font-weight: 700;
            color: #00b894;
            font-size: 1.2rem;
        }

        .table tbody td:nth-child(7),
        .table tbody td:nth-child(8) {
            font-size: 0.85rem;
            color: #7f8c8d;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .table {
                font-size: 0.85rem;
            }
            
            .table tbody td {
                padding: 15px 10px !important;
            }
            
            .btnContainer {
                min-width: 120px;
            }
            
            .blockBtn {
                padding: 8px 12px !important;
                font-size: 0.8rem !important;
            }
            
            .btn-warning.btn-lg {
                padding: 12px 20px !important;
                font-size: 0.9rem !important;
            }
        }

        /* Container Wrapper */
        .container-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Container for content */
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        /* Animation for smooth loading */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-container {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>
    <div class="container-wrapper">


        @extends('admin.layout')
        @section('content')
            <div class="push-top">
                <div>
                </div>
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
                    </div><br />
                @endif
                
                <table class="table push-top">
                    <thead>
                    <tr class="table-primary">
                        <td><i class="fas fa-hashtag"></i> ID</td>
                        <td><i class="fas fa-tag"></i> Tên sản phẩm</td>
                        <td><i class="fas fa-info-circle"></i> Mô tả</td>
                        <td><i class="fas fa-boxes"></i> Hàng tồn kho</td>
                        <td><i class="fas fa-dollar-sign"></i> Giá tiền</td>
                        <td><i class="fas fa-image"></i> Hình ảnh</td>
                        <td><i class="fas fa-calendar-plus"></i> Tạo lúc</td>
                        <td><i class="fas fa-calendar-edit"></i> Cập nhật lúc</td>
                        <td class="text-center">
                            <a href="{{ route('Cloths.create')}}" class="btn btn-warning btn-lg">Thêm</a>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cloths as $item)
                        <tr data-id="{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->product_description}}</td>
                            <td>{{$item->QuantityInWareHouse}}</td>
                            <td>{{$item->product_price}}.VNĐ</td>
                            <td><img src="{{ asset('storage/images/' . $item->product_image_url) }}" alt="Product Image" width="100%" height="100%"></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td class="btnContainer">
                                <form action="{{ route('Cloths.edit', $item->id)}}" method="get" style="display: inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-primary blockBtn">Cập nhật</button>
                                </form>

                                <form action="{{ route('Cloths.show', $item->id)}}" method="get" style="display: inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-primary blockBtn"> Chi tiết</button>
                                </form>

                                <form action="{{ route('Cloths.destroy', $item->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger blockBtn" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"> Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
                <div class="col-6">
                    <div class="card-body">
                    </div>
                    <div class="hidden-form">
                    </div>
                </div>
            </div>
        @endsection
    </div>
</body>
</html>