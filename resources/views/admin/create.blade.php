@extends('admin.layout')
@section('content')
    <style>
        .container {
            max-width: 450px;
        }
        .push-top {
            margin-top: 50px;
        }
    </style>
    <div class="card push-top">
        <div class="card-header">
            Create
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('Cloths.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" name="product_name"/>
                </div>
                <div class="form-group">
                    <label for="product_description">Description</label>
                    <input type="text" class="form-control" name="product_description"/>
                </div>

                <div class="form-group">
                    <label for="product_price">Price</label>
                    <input type="text" class="form-control" name="product_price"/>
                </div>

                <div class="form-group">
                    <label for="product_price">Image</label>
                    <input type="file" class="form-control" name="product_image_url"/>
                </div>
                <button type="submit" class="btn btn-block btn-danger">Create</button>
            </form>
        </div>
    </div>
@endsection
