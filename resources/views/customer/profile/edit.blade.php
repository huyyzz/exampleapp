@extends('customer.layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Fashion Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
                <p class="text-gray-600 mt-2">Manage your account settings and preferences</p>
            </div>

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button class="tab-btn active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-tab="personal">
                        <i class="fas fa-user mr-2"></i>Personal
                    </button>
                </nav>
            </div>

            <!-- Personal Information Tab -->
            <div id="personal-tab" class="tab-content">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Update your personal details and profile information</p>
                    </div>
                    <div class="px-6 py-6">
                        <!-- Profile Photo -->
                        

                        <!-- Personal Info Form -->
                        @if(session('success'))
                            <div id="toast" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow z-[99999] transition-opacity duration-500 opacity-100">
                                {{ session('success') }}
                            </div>

                            <script>
                                setTimeout(() => {
                                    const toast = document.getElementById('toast');
                                    if (toast) {
                                        toast.style.opacity = '0';
                                        setTimeout(() => toast.remove(), 500);
                                    }
                                }, 2000); 
                            </script>
                        @endif
                        <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text" 
                                    id="name" 
                                    name="name" 
                                    class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    value="{{ old('email', $user->name)}}">
                            </div>    

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>


                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                                <input type="text" id="addressInput" name="address" class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="{{ old('address', $user->address) }}">
                                <div id="map" style="height: 400px; margin-top: 20px;"></div>
                            </div>

                        

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Save Changes
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            


    <!-- Add Address Modal -->
    <div id="addAddressModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Add New Address</h3>
                    <button onclick="hideAddAddressModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="{{}}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Name</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="e.g., Home, Work">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                            <input type="text" name="street" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <input type="text" name="city" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                <input type="text" name="state" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ZIP Code</label>
                                <input type="text" name="zip_code" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <select name="country" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_default" value="1" class="rounded mr-2">
                            <label class="text-sm text-gray-700">Set as default address</label>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="hideAddAddressModal()" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    
    const map = L.map('map').setView([10.762622, 106.660172], 15); // Default center HCM

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    let marker = L.marker([10.762622, 106.660172], {draggable: true}).addTo(map);

    // Search by typing address
    document.getElementById('addressInput').addEventListener('change', function() {
        const address = this.value;
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length) {
                    const { lat, lon, display_name } = data[0];
                    map.setView([lat, lon], 17);
                    marker.setLatLng([lat, lon]);
                }
            });
    });

    // Click on map to move marker
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        marker.setLatLng([lat, lng]);
        
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
            .then(res => res.json())
            .then(data => {
                if (data.display_name) {
                    document.getElementById('addressInput').value = data.display_name;
                } else {
                    document.getElementById('addressInput').value = lat + ', ' + lng;
                }
            });
    });

        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');
                
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Remove active class from all buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Show selected tab content
                document.getElementById(tabName + '-tab').classList.remove('hidden');
                
                // Add active class to clicked button
                button.classList.add('active', 'border-blue-500', 'text-blue-600');
                button.classList.remove('border-transparent', 'text-gray-500');
            });
        });

        // Modal functions
        function showAddAddressModal() {
            document.getElementById('addAddressModal').classList.remove('hidden');
        }

        function hideAddAddressModal() {
            document.getElementById('addAddressModal').classList.add('hidden');
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=places"></script>
</body>
</html>
