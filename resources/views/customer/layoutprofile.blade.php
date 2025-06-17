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
