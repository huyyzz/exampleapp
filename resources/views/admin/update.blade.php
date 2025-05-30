@extends('admin.layout')
@section('content')
    <style>
        /*.container2 {*/
        /*    max-width: 450px;*/
        /*}*/
        .push-top {
            margin-top: 50px;
        }
    </style>

    <div class="card push-top " >
        <div class="card-header">
            Edit & Update
        </div>
        <div class="card-body" >
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form id='form' method="post" action="{{ route('Cloths.update', $cloths->id) }}" >
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="title">Product Name</label>
                    <input type="text" class="form-control" name="product_name" value="{{ $cloths->product_name }}"/>
                </div>
                <div class="form-group">
                    Description
                    <br>
                    <textarea form="form" name="product_description" rows="4" cols="150 " wrap="soft">{{ $cloths->product_description }}</textarea>
                </div>


                <div class="form-group">
                    Thêm số lượng sản phẩm có sẵn
                    <br>
                    <input type="number" min="0" class="form-control" name="inputQuantity">
                        <span style="color:#757575;opacity: .7">{{$cloths->QuantityInWareHouse}} sản phẩm có sẵn</span>
                    </input>
                </div>


                <div class="form-group">
                    <label for="content">Price</label>
                    <input type="text" class="form-control" name="product_price" value="{{ $cloths->product_price }}"/>
                </div>

                <button type="submit" class="btn btn-block btn-danger">Update</button>
            </form>
        </div>
    </div>
@endsection
