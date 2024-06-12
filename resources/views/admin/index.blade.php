
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
@extends('admin.layout')
@section('content')

    <style>
        .push-top {
            margin-top: 50px;
        }
        .hidden-form {
            display: None;
        }
    </style>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
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
                    <li><a href="#" ><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRunR8mq9MYERvPi5vDff-HHn4kFeJpXEpWO6cg0_Yzg&s" width="70" height="45" alt=""></a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Thống kê doanh thu </a></li>
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
                    <td style="background-color: #ccc2a4">{{$item->product_name}}</td>
                    <td style="background-color: #ccc2a4">{{$item->product_description}}</td>
                    <td style="background-color: #ccc2a4">{{$item->product_price}}</td>
                    <td style="background-color: #ccc2a4"><img src="{{ asset('storage/images/' . $item->product_image_url) }}" alt="Product Image" width="150px" height="150px"></td>
                    <td style="background-color: #ccc2a4">{{$item->created_at}}</td>
                    <td style="background-color: #ccc2a4">{{$item->updated_at}}</td>
                    <td style="background-color: #ccc2a4" class="text-center">
                        <a href="{{ route('Cloths.edit', $item->id)}}" class="btn btn-primary btn-sm">Update</a>

                        <a href="{{ route('Cloths.show', $item->id)}}" class="btn btn-primary btn-sm">Show details</a>

                        <form action="{{ route('Cloths.destroy', $item->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>

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
