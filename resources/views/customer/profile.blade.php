@extends('customer.layout')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  







<!-- @extends('customer.layoutprofile') -->

@section('profile')
<div class="min-h-screen bg-gray-50 p-4 md:p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div style="margin-top: 1rem;">
                <h1 class="text-3xl font-bold text-gray-900">Thông tin cá nhân</h1>
                <p class="text-gray-600 mt-1">Quản lý thông tin và lịch sử mua hàng</p>
            </div>
            <a href="{{ route('editProfile') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Chỉnh sửa
            </a>
        </div>

        <!-- Customer Overview -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <div class="flex items-start gap-6">
                <div class=" text-sm text-gray-600">
                    <span>Tên khách hàng:<input type="text" value="{{$user->name}}"></span>
                   </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <span>{{ $user->phone }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>Khách hàng từ {{ $user->since }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>{{ $user->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
<!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6 mb-6">
            <div class="bg-white rounded-lg shadow">
                <div class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tổng đơn hàng</p>
                            <p class="text-2xl font-semibold">{{ number_format($user->donHangDaHoanThanh ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow" >
                <div class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tổng chi tiêu</p>
                            <p class="text-2xl font-semibold">
                                {{ number_format($user->tongChiTieu ?? 0) }} ₫
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="bg-white rounded-lg shadow">
                <div class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Đơn hàng trong 30 ngày</p>
                            <p class="text-2xl font-semibold">
                                {{ number_format($user->donHangTrongMotThang ?? 0) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="customerTabs" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-blue-600 rounded-t-lg active" id="orders-tab" data-tabs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="true">Lịch sử đơn hàng</button>
                    </li>
                    <!-- <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="preferences-tab" data-tabs-target="#preferences" type="button" role="tab" aria-controls="preferences" aria-selected="false">Sở thích</button>
                    </li> -->
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="addresses-tab" data-tabs-target="#addresses" type="button" role="tab" aria-controls="addresses" aria-selected="false">Địa chỉ</button>
                    </li>
                    <!-- <li role="presentation">
                        <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="activity-tab" data-tabs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Hoạt động</button>
                    </li> -->
                </ul>
            </div>
            <div id="customerTabContent">
                <div class="p-4 rounded-lg bg-white" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    <div class="bg-white rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-1">Đơn hàng gần đây</h3>
                            <!-- <p class="text-sm text-gray-600 mb-4">5 đơn hàng mới nhất của khách hàng</p> -->
                            <div class="space-y-4">
                                @foreach($orders as $order)
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div class="flex items-center gap-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                        <div>
                                            <p class="font-medium">Mã đơn: #{{ $order->id }}</p>
                                            <p class="text-sm text-gray-600">{{ $order['items'] }}</p>
                                            <p class="text-xs text-gray-500">Ngày: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                            <p class="text-xs text-gray-500">Mã vận đơn: {{ $order->shipping_code }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold">{{ number_format($order->sub_total, 0, ',', '.') }} đ</p>
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded border border-green-600 text-green-600">
                                               @if($order->isPaid)
                                               Đã thanh toán
                                               @else
                                               Chưa thanh toán
                                               @endif
                                        </span>
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded border border-green-600 text-green-600">
                                               {{ $order->status }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                </div>
                <div class="hidden p-4 rounded-lg bg-white" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                    <div class="bg-white rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-4">Địa chỉ giao hàng</h3>
                            <div class="space-y-4">
                                @if($addresses == null)
                                    <p class="text-sm text-gray-600">Chưa có địa chỉ giao hàng.</p>
                                @else
                                        <div class="p-4 border rounded-lg">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <p class="font-medium"></p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        {{ $addresses }}<br>
                                                    </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</script>
@endsection('profile')



<section class="mt-12">
    @yield('profile')
</section>


