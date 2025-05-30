<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart</title>


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
@extends('customer.layout')
@section('content')
    <div class="row" style="margin-top: 5rem">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="cart-table dropdown">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Trạng thái</td>
                        <td>Thời gian đặt hàng</td>

                        <td>Chi tiết đơn hàng</td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>

                            <td>{{$order->status}}</td>

                            <td>{{$order->updated_at}}</td>


                            <td>
                                <form method="get" action="{{route('order.details',$order->id)}}">
                                    <button class="btn btn-outline-success">Thông tin đơn hàng</button>
                                </form>
                            </td>
                            @if ($order->status == "Chờ duyệt đơn")
{{--                                <td>--}}
{{--                                    <form method="get" action="{{route('order.details',$order->id)}}">--}}
{{--                                        <button class="btn btn-outline-danger">Hủy đơn hàng</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
                                <td>
                                    <form method="post" action="{{route('orderUpdate',$order->id)}}">
                                        @csrf
                                        <input type="hidden" name="status" value='Đã hủy'>
                                        <button class="btn btn-outline-success">Hủy đơn hàng</button>
                                    </form>
                                </td>
                            @else
                                <td></td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
{{--                    <td colspan="5">--}}
{{--                        Subtotal--}}
{{--                        <span class="float-end">{{$order->sub_total}}</span>--}}
{{--                    </td>--}}

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
