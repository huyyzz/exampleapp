<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
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
        .cart-icon{
            color: black;
            text-decoration: none;
        }
        .cart-icon:hover{
            text-decoration: none;
            color: red;
        }

    </style>
</head>

<body>
@extends('admin.layout')
@section('content')
    <div class="row" style="margin-top: 5rem">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="cart-table dropdown">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td>Số lượng sản phẩm</td>
                            <td>Hình ảnh</td>
                            <td>Giá sản phẩm</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$item->cloths->product_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td><img src="{{asset('storage/images/'.$item->cloths->product_image_url)}}" height="150px" width="150px"></td>
                            <td>{{number_format($item->product_price, 0)}} VNĐ</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <td colspan="5">
                            Subtotal
                            <span class="float-end">{{number_format($order->sub_total,0) }} VNĐ</span>
                        </td>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
