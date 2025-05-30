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


<script>

{{--    $.getJSON("{{asset('storage/locations/json_data_vn_units.json')}}", function(data) {--}}
{{--        // var districts = [];--}}
{{--        var _index = 0--}}
{{--        // var districts = []--}}
{{--        $.each(data, function() {--}}
{{--            var select = document.getElementById("province");--}}
{{--            var option = document.createElement("option");--}}
{{--            option.text = data[_index].Name;--}}
{{--            option.value = data[_index].Name;--}}
{{--            select.add(option);--}}

{{--            // districts[_index] = data[_index].District;--}}

{{--            _index++;--}}
{{--        });--}}

{{--        // const districtSelect = document.getElementById('district');--}}


{{--        const provinceSelect = document.getElementById('province');--}}
{{--        provinceSelect.addEventListener('change', handleProvinceChange);--}}
{{--        const districtSelect = document.getElementById('district');--}}
{{--        districtSelect.addEventListener('change', handleDistrictChange);--}}
{{--        function handleDistrictChange() {--}}

{{--            // Get selected district code--}}
{{--            const districtCode = districtSelect.value;--}}

{{--            // Find district in data--}}
{{--            let district;--}}
{{--            var ___index = 0;--}}

{{--            for(;___index < data[___index].District.length; ___index++) {--}}

{{--                const d = data[___index].District;--}}

{{--                console.log(d.Name);--}}

{{--                if(d.Name == districtCode) {--}}
{{--                    district = d;--}}
{{--                    console.log(district);--}}
{{--                }--}}

{{--                console.log(___index);--}}

{{--            }--}}

{{--            // Get wards from found district--}}
{{--            var wards = district.Ward;--}}
{{--            console.log(wards)--}}

{{--            updateWardSelect(wards);--}}

{{--        }--}}
{{--        function updateWardSelect(wards) {--}}

{{--            const wardSelect = document.getElementById('ward');--}}

{{--            wardSelect.innerHTML = '';--}}

{{--            wards.forEach(ward => {--}}

{{--                const option = document.createElement('option');--}}
{{--                option.value = ward.Name;--}}
{{--                option.innerText = ward.Name;--}}

{{--                wardSelect.appendChild(option);--}}

{{--            });--}}

{{--        }--}}
{{--        function updateDistrictSelect(districts) {--}}
{{--            districtSelect.innerHTML = '';--}}
{{--            districts.forEach(district => {--}}
{{--                const option = document.createElement('option');--}}
{{--                option.value = district.Name;--}}
{{--                option.innerText = district.Name;--}}

{{--                districtSelect.appendChild(option);--}}
{{--            });--}}

{{--        }--}}
{{--        function handleProvinceChange() {--}}
{{--            const provinceName = this.value;--}}
{{--            console.log(provinceName);--}}

{{--            // Find province data--}}
{{--            const province = data.find(p => p.Name === provinceName);--}}
{{--            // Get districts--}}
{{--            const districts = province.District;--}}
{{--            const firstDistrict = districts[0];--}}
{{--            // Update district options--}}
{{--            updateDistrictSelect(districts);--}}
{{--            districtSelect.value = '';--}}
{{--        }--}}


{{--    });--}}

</script>
@endsection('content')
