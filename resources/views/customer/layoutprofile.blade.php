<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng - Shop quần áo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-gray-900">Shop Quần Áo</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                    <button class="text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </button>
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="font-medium text-gray-700">A</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script>
        // Simple tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[data-tabs-target]');
            const tabContents = document.querySelectorAll('[role="tabpanel"]');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const target = document.querySelector(tab.dataset.tabsTarget);
                    
                    tabContents.forEach(tabContent => {
                        tabContent.classList.add('hidden');
                    });
                    
                    tabs.forEach(tab => {
                        tab.classList.remove('border-blue-600');
                        tab.classList.add('border-transparent');
                        tab.setAttribute('aria-selected', false);
                    });
                    
                    tab.classList.remove('border-transparent');
                    tab.classList.add('border-blue-600');
                    tab.setAttribute('aria-selected', true);
                    
                    target.classList.remove('hidden');
                });
            });
        });
    </script>
</body>
</html>
