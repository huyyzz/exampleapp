<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />--}}
{{--    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">--}}

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

        .hidden2 {
            opacity: 1;
            transition: opacity 1.2s ease-in-out;
        }

        .hidden2.fade {
            opacity: 0;
        }

    </style>
</head>

<body>
@extends('customer.layout')
@section('content')
    <div class="row" style="margin-top: 5rem">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="cart-table dropdown">
                <a href="{{ url('clear-cart') }}" class="cart-icon"><i class="fas fa-trash"></i> Clear cart</a>


            </div>
        </div>
    </div>
    <form method="post" action="{{route('checkOut')}}">
        @csrf
    <table id="cart" class="table table-bordered table-hover table-condensed mt-3">
        <thead>
        <tr>
            <th style="width:50%">Sản phẩm</th>
            <th style="width:10%">Giá</th>
{{--            <th style="width:8%">Giá</th>--}}
            <th style="width:8%">Số lượng</th>
            <th style="width:22%" class="text-center">Tổng</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $total = 0;
        $index= 0;
        ?>
        @if(session()->has('success'))
            <div class="alert alert-success ">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session('cart'))

            @foreach(session('cart') as $id => $details)
                <div id="index"></div>

                    <?php
                    $total += $details['price'] * $details['quantity'];
                    $index+= 1;

                    ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src='{{asset("storage/images/". $details["image"]) }}' width="150" height="150" class="img-responsive" />

                            </div>

                            <div class="col-sm-9">
                                <p class="nomargin">{{ $details['name'] }}</p>
                                <p class="remove-from-cart cart-delete" data-id="{{ $id }}" title="Delete"><i class="fas fa-trash"></i> Remove</p>
                            </div>
                        </div>
                    </td>
                    <td style="display: none" data-th="Price">{{$details['price']}}</td>
                    <td style="display: none" data-th="Id">
                        {{$details['id']}}
                        <input name="data[{{$index}}][id]" type="text" value="{{$details['id']}}">

                    </td>
                    <td>
                        {{$details['price']}}
                    </td>
                    <td data-th="Quantity">
                        <input style="" name="data[{{$index}}][quantity]" type="number" min="1" max="{{$details['QuantityInWareHouse']}}" value="{{$details['quantity']}}" class="form-control quantity" />
                    </td>
                    <td style="display: none" data-th="QuantityInWareHouse">
                        {{$details['QuantityInWareHouse']}}
                    </td>

                    <td data-th="Subtotal" class="text-center"></td>
                </tr>

            @endforeach
        @endif

        </tbody>
        <tfoot>
        @if(!empty($details))
            <tr class="visible-xs">
                <th class="text-left" colspan="3"><strong>Total</strong></th>
                <th id="total" class="text-center" data-td="total"></th>
            </tr>
        @else
            <tr>
                <td class="text-center" colspan="4">Your Cart is Empty.....</td>
            <tr>
        @endif
        </tfoot>

    </table>
    <a href="{{ route('customer.home') }}" class="btn shopping-btn">Continue Shopping</a>

    <a onclick="this.closest('form').submit();return false;" id="submit" href="#" class="btn btn-warning check-btn">Proceed Checkout</a>

    </form>
    <div> <br><hr>   </div>
    <div class="table table-bordered table-hover table-condensed mt-3 text-center"><h5>Thông tin mua hàng của bạn </h5>
    </div>

     <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <div class="flex items-start gap-6">
                <div class=" text-sm text-gray-600">
                    <span>Tên khách hàng:<input type="text" value="{{$user->name}}"></span>
                   </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $user->phone }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Khách hàng từ {{ $user->since }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>{{ $user->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



{{--    {{ route('checkOut')}}--}}
{{--    {!!json_encode(session('cart'))!!}--}}
{{--    <div class="container products">--}}

{{--        <div class="row">--}}

{{--            @foreach($products as $product)--}}
{{--                <div class="col-xs-12 col-sm-6 col-md-4">--}}
{{--                    <div class="card mb-4">--}}
{{--                        <img src="{{asset("storage/images/". $product->product_image_url )}}" class="card-img-top img-size" alt="{{ $product->name }}">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{ $product->name }}</h5>--}}
{{--                            <p class="card-text">{{ \Illuminate\Support\Str::limit(strtolower($product->description), 50) }}--}}
{{--                            </p>--}}
{{--                            <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>--}}
{{--                            <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--        </div>--}}

{{--    </div>--}}

@endsection
</body>
@section('scripts')
{{--    <script type="text/javascript">--}}
{{--        function checkOut(obj){--}}
{{--            console.log(JSON.stringify(obj))--}}
{{--            // Say it's your request payload--}}
{{--            let details = {--}}
{{--                name: 'John Doe',--}}
{{--                city: 'Mumbai',--}}
{{--                status: 'Payment done',--}}
{{--                _token: $('meta[name="csrf-token"]').attr('content')--}}
{{--            };--}}
{{--            $.ajax({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                },--}}
{{--                'url': '{{route('checkOut')}}',--}}
{{--                'type': 'POST',--}}
{{--                'dataType': 'json',--}}
{{--                'data': details,--}}
{{--            }).done(function (response) {--}}
{{--                alert('success: ' + JSON.stringify(response));--}}
{{--                // Redirect to response url--}}
{{--                window.location.replace(response.url);--}}
{{--            }).fail(function(xhr, ajaxOps, error) {--}}
{{--                console.log('Failed: ' + error);--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });

        var quantityInputs = document.querySelectorAll('.quantity');
        var total = document.querySelector('[data-th="total"]');
        quantityInputs.forEach(function(quantityInput) {
            //init
            var Quantity = parseInt(quantityInput.value);
            var QuantityInWareHouse = parseInt(quantityInput.closest('tr').querySelector('[data-th="QuantityInWareHouse"]').innerHTML.split(' ')[0]);
            // if (Quantity > QuantityInWareHouse) {
            //     quantityInput.value = QuantityInWareHouse;
            // }

            // if (Quantity > $product->QuantityInWareHouse)
            var price = parseFloat(quantityInput.closest('tr').querySelector('[data-th="Price"]').innerHTML.split(' ')[0]);
            var Subtotal = price * Quantity;
            var formattedSubtotal = formatter.format(price * Quantity)

            quantityInput.closest('tr').querySelector('[data-th="Subtotal"]').innerHTML = formattedSubtotal;
            //end
            total = total + Subtotal //Tong gia init
            document.getElementById('total').innerHTML = formatter.format(total);

            var productId = parseInt(quantityInput.closest('tr').querySelector('[data-th="Id"]').innerHTML.split(' ')[0]) ;
            quantityInput.addEventListener('change', function() {
                price = parseFloat(quantityInput.closest('tr').querySelector('[data-th="Price"]').innerHTML.split(' ')[0]);
                var oldPrice = Quantity*price


                productId = parseInt(quantityInput.closest('tr').querySelector('[data-th="Id"]').innerHTML.split(' ')[0]) ;
                Quantity = parseInt(quantityInput.value);
                if (Quantity >= QuantityInWareHouse+1) {
                    Quantity = QuantityInWareHouse;
                    quantityInput.value = QuantityInWareHouse;
                }
                Subtotal = price * Quantity;
                formattedSubtotal = formatter.format(price * Quantity)

                priceChange = Quantity*price - oldPrice

                quantityInput.closest('tr').querySelector('[data-th="Subtotal"]').innerHTML = formattedSubtotal;

                var tempPrice = Subtotal
                total = total + priceChange

                document.getElementById('total').innerHTML = formatter.format(total);

                localStorage.setItem('quantity' + productId, Quantity);

                // quantityInput.value = localStorage.getItem('quantity' + productId);

            });

        });
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove product from the cart.")) {
                $.ajax({
                    url: '{{ url("remove-from-cart") }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>

</html>
@endsection
