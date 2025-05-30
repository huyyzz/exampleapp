
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
            box-sizing: border-box
        }

        .btnContainer {
            background-color: #ddd;
            padding: 10px;
            margin: 0 auto;
            max-width: 500px;
        }
        .blockBtn {
            background-color: #bbb;
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 100%;
        }
    </style>
@extends('admin.layout')
@section('content')
    <div class="push-top">
        <div>
        </div>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />

        @endif
        <table style="background-color: #ccc2a4" class="table push-top ">
            <thead>
            <tr class="table-primary">
                <td>ID</td>
                <td>Product Name</td>
                <td>Description</td>
                <td>Left in stock</td>
                <td>Price</td>
                <td>Image</td>
                <td>created_at</td>
                <td>updated_at</td>
                <td class="text-center">
                    <a href="{{ route('Cloths.create')}}" class="btn btn-warning btn-lg">Create</a>
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach($cloths as $item)
                <tr data-id="{{$item->id}}">
                    <td style="background-color: #ccc2a4">{{$item->id}}</td>
                    <td style="width:10rem;background-color: #ccc2a4">{{$item->product_name}}</td>
                    <td style="width:25rem;background-color: #ccc2a4">{{$item->product_description}}</td>
                    <td style="background-color: #ccc2a4">{{$item->QuantityInWareHouse}}</td>
                    <td style="background-color: #ccc2a4">{{$item->product_price}}</td>
                    <td style="background-color: #ccc2a4"><img src="{{ asset('storage/images/' . $item->product_image_url) }}" alt="Product Image" width="150px" height="150px"></td>
                    <td style="background-color: #ccc2a4">{{$item->created_at}}</td>
                    <td style="background-color: #ccc2a4">{{$item->updated_at}}</td>
                    <td style="background-color: #ccc2a4;width:10%" class="btnContainer">


                        <form action="{{ route('Cloths.edit', $item->id)}}" method="get" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary blockBtn">Update</button>
                        </form>


                        <form action="{{ route('Cloths.show', $item->id)}}" method="get" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-primary blockBtn">Details</button>
                        </form>

{{--                        <form action="{{ route('update.quantity', $item->id)}}" method="post" style="display: inline-block">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-primary blockBtn">Details</button>--}}
{{--                        </form>--}}

                        <form action="{{ route('Cloths.destroy', $item->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger blockBtn" type="submit">Delete</button>


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
        <div>
@endsection


