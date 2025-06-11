@extends('customer.layout')
@section('content')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
    <div class="container">

        <div class="mt-3">
            <div>
                <h5>Hồ Sơ Của Tôi
                    <br>
                    Quản lý thông tin hồ sơ để bảo mật tài khoản
                    <br>
                </h5>
            </div>
            <div>
                @if(session()->has('Error'))
                    <div class="font-weight-bold alert alert-danger hidden2">
                        {{ session()->get('Error') }}
                    </div>
                @endif
                <form class="form" action="" method="get" style="display: inline-block">
                    @csrf
                    <label class="form-label" >Email
                        <input class="form-control" type="text" value="{{$user->email}}" disabled>
                    </label>
                    <br>
                    <label class="form-label">Tên người mua
                        <input type="text" value="{{$user->name}}">
                    </label>
                    <br>
                    <div>
                        <label>Số nhà/Ngõ/Ngách/Hẻm
                            <input type="text" value="">
                        </label>

                        <label>Phường
                            <select id="ward" name="ward">
                            <option value="" SELECTED DISABLED HIDDEN>Chọn Quận/Huyện</option>
                            </select>
                        </label>
                        <label>Quận/huyện
                            <select id="district" name="district">
                                <option value="" SELECTED DISABLED HIDDEN>Chọn Tỉnh/Thành Phố</option>
                            </select>
                        </label>
                        <label>Tỉnh/Thành phố
                            <select id="province" name="province">
                                <option value="" SELECTED></option>
                            </select>
                        </label>

                    </div>
                    Số điện thoại :{{$user->phone}}
                    <br>
                    <button type="submit" class="btn btn-primary blockBtn">
                        SUBMIT
                    </button>
                </form>
            </div>

            <div id="userdata"></div>

    </div>


@endsection('content')