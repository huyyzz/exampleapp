<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            align-items: center;
            height: 80vh;
        }

        .export-btn {
            padding: 15px 30px;
            font-size: 18px;
            background: #0099FF;
            margin-top: 20px;
        }

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

        .adding-cart {
            display: none;
        }

        #adding-cart {
            display: none;
        }
    </style>
</head>

<body>
@extends('layout')
@section('title', 'Products')

@section('content')
    <div class="container mt-5">
        <h2>Product Gallery</h2>
    </div>

    <div class="container products">
        <div class="row">
            @if(!empty($products))
                @foreach($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $product->photo }}" class="card-img-top img-size" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit(strtolower($product->description), 50) }}
                                </p>
                                <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>
                                <a href="javascript:void(0);" data-product-id="{{ $product->id }}" id="add-cart-btn-{{ $product->id }}" class="btn btn-warning btn-block text-center add-cart-btn add-to-cart-button">Add to cart</a>
                                <span id="adding-cart-{{ $product->id }}" class="btn btn-warning btn-block text-center added-msg" style="display:none;">Added.</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div><!-- End row -->
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart-button').on('click', function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    type: 'GET',
                    url: '/add-to-cart/' + productId,
                    success: function(data) {
                        $("#adding-cart-" + productId).show();
                        $("#add-cart-btn-" + productId).hide();
                    },
                    error: function(error) {
                        console.error('Error adding to cart:', error);
                    }
                });
            });
        });
    </script>
@endsection

</body>

</html>
