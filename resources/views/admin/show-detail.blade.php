<link rel="stylesheet" href="{{asset('bootstrap-5.3.3/bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--@section('title','Chi tiết sanr phẩm')--}}



{{--    <div class="float-right">--}}
{{--        <a href='{{ route('Cloths.index') }}' class="btn btn-warning btn-lg ">Back</a>--}}
{{--    </div>--}}
{{--    <div style="border-style: solid " class="container align-content-center text-danger text-center">--}}
{{--        <h1>Name product: {{ $cloth->product_name }}</h1>--}}
{{--        <p>The description: {{ $cloth->product_description }}</p>--}}
{{--        <p>Price: {{ $cloth->product_price }}</p>--}}
{{--        <img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" alt="Product Image" width="150px" height="150px">--}}
{{--        <form>--}}
{{--            @csrf--}}
{{--            <button type="submit" class="btn btn-outline-light me-2">Back</button>--}}
{{--        </form>--}}
{{--    </div>--}}


{{--@endsection--}}


<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card text-black">

                    <div class="pt-4">
                        <h6 class="mb-0"><a href='{{ route('Cloths.index') }}' class="text-body"><i
                                    class="fas fa-long-arrow-alt-left me-2"></i>Go back</a></h6>
                    </div>

                    <img src="{{ asset('storage/images/' . $cloth->product_image_url) }}" alt="Product Image" >
                    <div class="card-body">
                        <div class="text-center">
                            <h4>Name product: {{ $cloth->product_name }}</h4>

                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <span>The description</span><span> {{ $cloth->product_description }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <span>Price</span><span> {{ $cloth->product_price }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







