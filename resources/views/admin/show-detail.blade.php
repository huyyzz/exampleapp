@extends('admin.layout')
@section('title','Chi tiết sanr phẩm')

@section('content')

    <div class="float-right">
        <a href='{{ route('Cloths.index') }}' class="btn btn-warning btn-lg ">Back</a>
    </div>
    <div style="border-style: solid " class="container align-content-center text-danger text-center">
        <h1>Name product: {{ $cloth->product_name }}</h1>
        <p>The description: {{ $cloth->product_description }}</p>
        <p>Price: {{ $cloth->product_price }}</p>
        <img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" alt="Product Image" width="150px" height="150px">
        <form>
            @csrf
            <button type="submit" class="btn btn-outline-light me-2">Back</button>
        </form>
    </div>


@endsection
