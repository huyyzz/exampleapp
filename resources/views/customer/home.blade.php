@extends('customer.layout')
@section('content')

    <style>
        .hidden2 {
            opacity: 1;
            transition: opacity 1.2s ease-in-out;
        }

        .hidden2.fade {
            opacity: 0;
        }

        .aspect-ratio-169 {
        display: block;
        position: relative;
        padding-top: 56.25%;
        transition: 0.3s;
        }

        .aspect-ratio-169 img {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        }
        .dot-container {
            position: absolute;
            height: 30px;
            width: 100%;
            display: flex;    
            align-items: center;
            text-align: center;
            justify-content: center;
        }
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            background-color: #CCC;
            margin-right: 12px;
            cursor: pointer;
        
        }

        .dot.active {
            background-color: #333;
        }
        #Slider{
            padding-bottom: 30px;
            border-bottom: 2px solid #000;
            overflow: hidden;
        }

    </style>

  <section id="Slider">
    <div class="aspect-ratio-169">
        <img src ="https://cotton4u.vn/files/news/2025/05/20/0f2a946ec41995fedf32b904a3c8175b.webp">
        <img src ="https://cotton4u.vn/files/news/2025/04/23/0cd827900f8d75840487982c44506798.webp">
        <img src ="https://cotton4u.vn/files/news/2025/05/15/7632553893f40eb4ddd8a5010cc94843.webp">
        <img src ="https://bizweb.dktcdn.net/100/405/002/files/z6179000317002-80f849a1eb70507ee169151058504eb3.jpg?v=1735804196933">
        <img src ="https://lh7-rt.googleusercontent.com/docsz/AD_4nXcBlZyYooDJRHfwv9FYZkMTyXmPtRZTwGoRk_7rrZA6ronMTvyItrijm6FUE2d5ZcCOHWHLN6YY-S-asC8e-60TDecBdWfxLNXk7yDAytNdn_3dwCr7q2yWqxr0NVuo2VEJCDHN?key=pGlm5FVY_DCkUFKq_iW5JMpY">

    </div>
    <div class="dot-container">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
  </section>

 
      
<div class="container">
    <div class="row py-4 shadow-5 d-flex ">
        <h1 class="text-center">Sản phẩm bán chạy</h1>
        @if(session()->has('success'))
            <div class="font-weight-bold alert alert-success hidden2">
                {{ session()->get('success') }}
            </div>
        @endif
        @if ($specific != null)
            @foreach($specific as $item)
                <div class="col col-4 mb-4">
                    <div  alt="Product Image" class="col col-4 m-3 card h-100 p-3" style="width:18rem;"  data-id="{{$item->id}}" >
                        <a href='{{ route('showcus',$item->id) }}'><img  src="{{ asset('storage/public/images/' . $item->product_image_url) }}" width="260" height="300"  alt="Product Image" ></a>

                        <div class="d-flex flex-column bd-highlight mb-3 justify-content-between h-100">
                            <div class="d-flex mt-1">
                                <h5>{{ \Illuminate\Support\Str::limit($item->product_name,50) }}</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span style="font-weight: bold;font-size: 1.25rem" class="text-danger align-content-center">{{ number_format($item->product_price,0) }} VNĐ</span>
                                <form method="get" action="{{route('addToCart',$item->id)}}">
                                    <button class="btn btn-outline-danger me-1 float-end" type="submit">+<i class="bi-cart-fill me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        @foreach($cloths as $item)

                <div class="col col-4 mb-4">
                    <div  alt="Product Image" class="m-3 card h-100 p-3" style="width:18rem;"  data-id="{{$item->id}}" >
                        <a href='{{ route('showcus',$item->id) }}'><img  src="{{ asset('storage/images/' . $item->product_image_url) }}" width="260" height="300"  alt="Product Image" ></a>

                        <div class="d-flex flex-column bd-highlight mb-3 justify-content-between h-100">
                            <div class="d-flex mt-1">
                                <h5>{{ \Illuminate\Support\Str::limit($item->product_name,50) }}</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span style="font-weight: bold;font-size: 1.25rem" class="text-danger align-content-center">{{ number_format($item->product_price,0) }} VNĐ</span>
                                <form method="get" action="{{route('addToCart',$item->id)}}">
                                    <input type="hidden" value="1" name="inputQuantity" id="inputQuantity" min="1" max="999">
                                    <button class="btn btn-outline-danger me-1 float-end" type="submit">+<i class="bi-cart-fill me-1"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <script>
                window.addEventListener('load', () => {
                    if (document.querySelector('.hidden2') !== null){
                        const div = document.querySelector('.hidden2');
                        div.classList.add('fade');

                        div.addEventListener('transitionend', () => {
                            div.remove();
                        });
                    }
                });
            </script>
        @endforeach
        @endif
    </div>
{{--    <hr>--}}
{{--    <h4>Áo</h4>--}}
{{--    <div class="row py-4 shadow-5 d-flex">--}}
{{--        @foreach($ao as $item)--}}
{{--            <div  alt="Product Image" class="col col-4 m-3 card" style="width: 18rem"  data-id="{{$item->id}}" >--}}
{{--                <a href='{{ route('showcus',$item->id) }}'><img  src="{{ asset('storage/images/' . $item->product_image_url) }}" width="260" height="300"  alt="Product Image" ></a>--}}
{{--                <div class="d-flex flex-column bd-highlight mb-3">--}}
{{--                    <div>--}}
{{--                        <h1>{{\Illuminate\Support\Str::limit($item->product_name,50) }}</h1>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p>Price: {{ $item->product_price }} VNĐ</p>--}}
{{--                        <button class="btn btn-outline-dark me-1" type="submit">Add</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endforeach--}}
{{--    </div>--}}
{{--    <hr>--}}
{{--    <h4>Quần</h4>--}}

{{--    <div class="row py-4 shadow-5 d-flex">--}}
{{--        @foreach($quan as $item)--}}
{{--            <div  alt="Product Image" class="col col-4 m-3 card" style="width: 18rem"  data-id="{{$item->id}}" >--}}
{{--                <a href='{{ route('showcus',$item->id) }}'><img  src="{{ asset('storage/images/' . $item->product_image_url) }}" width="260" height="300"  alt="Product Image" ></a>--}}


{{--                <div class="d-flex flex-column bd-highlight mb-3">--}}
{{--                    <div>--}}
{{--                        <h1>{{ $item->product_name }}</h1>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p>Price: {{ $item->product_price }} VNĐ</p>--}}
{{--                        <button class="btn btn-outline-dark me-1" type="submit">Add</button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        @endforeach--}}
{{--        --}}
{{--    </div>--}}

</div>


<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.facebook.com/HuyShop10101994/?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
            <a href="https://www.facebook.com/tao1407?locale=vi_VN" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>


        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>Huy shop
                    </h6>
                    <p>
                        Cảm ơn bạn đã xem sản phẩm của chúng tôi. Ngoài ra,
                        đây là thông tin liên hệ và hỗ trợ khách hàng khi có sản phẩm
                        bị lỗi từ nhà sản xuất.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
{{--                    <h6 class="text-uppercase fw-bold mb-4">--}}
{{--                        Sản phẩm--}}
{{--                    </h6>--}}
{{--                    <p>--}}
{{--                        <a href="#!" class="text-reset" style="text-decoration: none">Adidas</a>--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <a href="#"  class="text-reset" style="text-decoration: none">Nike</a>--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <a href="#!" class="text-reset" style="text-decoration: none">LV</a>--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <a href="#!" class="text-reset" style="text-decoration: none">Gucci</a>--}}
{{--                    </p>--}}
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Hỗ trợ khách hàng
                    </h6>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Q&A</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Advise</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset" style="text-decoration: none">Orders</a>
                    </p>
                    <p>
                        <a  href="#!" class="text-reset" style="text-decoration: none">Help</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Liên lạc</h6>
                    <p><i class="fas fa-home me-3"></i> Hanoi, Hadong Vietnam</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        LuxyShop@gmail.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> + 0563 456 195</p>
                    <p><i class="fas fa-print me-3"></i> + 0904 775 377</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">

        Domestic goods:
        <a class="text-reset fw-bold">Cloth SHOP VIP123</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</body>


<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector('.aspect-ratio-169')
    const dotItem = document.querySelectorAll(".dot");
    let index = 0
    let imgNumber = imgPosition.length 
    // console.log(imgPosition);
    imgPosition.forEach(function(image,index){
        image.style.left = index*100+ "%"
        dotItem[index].addEventListener("click",function(){
        slider (index)
        })
    })
    function imgSlide(){
        index++;
        console.log(index)
        if(index >= imgNumber){
            index = 0
        }
        slider (index) 
    }
    function slider (index){
        imgContainer.style.left = "-" + index * 100 + "%" 
        const dotActive = document.querySelector(".active")
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }

    setInterval(imgSlide,5000)
</script>

</html>
@endsection


