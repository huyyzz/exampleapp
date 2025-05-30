@extends('admin.layout')
@section('content')
    <style>
        /*.container {*/
        /*    max-width: 450px;*/
        /*}*/
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
            <form id="form" method="post" action="{{ route('Cloths.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" name="product_name"/>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="product_description">Description</label>--}}
{{--                    <input type="text" class="form-control" name="product_description"/>--}}
{{--                </div>--}}
                <div class="form-group">
                    Description
                    <br>
                    <textarea form="form" name="product_description" rows="4" cols="40" wrap="soft"></textarea>
                </div>

                <div class="form-group">
                    Thêm số lượng sản phẩm có sẵn
                    <br>
                    <input type="number" min="0" class="form-control" name="QuantityInWareHouse">
                    </input>
                </div>

                <div class="form-group">
                    <label for="product_price">Price</label>
                    <input type="text" class="form-control" name="product_price"/>
                </div>

                <div class="form-group">
                    Brand
                    <br>
                    <select name="brand_id" id="brand_id">
                        <option value="1" SELECTED>NO BRAND</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    Category
                    <br>
                    <select name="category_id" id="category_id">
                        <option value="" SELECTED>NO SPECIFY</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
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
