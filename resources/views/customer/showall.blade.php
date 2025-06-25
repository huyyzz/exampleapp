@extends('customer.layout')

@section('content')
<style>
/* Price Filter Container */
.filter-container {
    background: #ffffff;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
    padding: 20px;
    width: 280px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Filter Section */
.filter-section {
    margin-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 16px;
}

.filter-section:last-of-type {
    border-bottom: none;
    margin-bottom: 24px;
}

/* Section Header */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 8px 0;
}

.section-title {
    font-size: 14px;
    font-weight: 400;
    color: #333;
    margin: 0;
}

.section-title.active {
    color: #007bff;
}

.toggle-btn {
    width: 20px;
    height: 20px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: #666;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toggle-btn:hover {
    border-color: #007bff;
    color: #007bff;
}

.toggle-btn.expanded {
    background: #f8f9fa;
    color: #333;
}

/* Section Content */
.section-content {
    display: none;
    padding-top: 16px;
}

.section-content.expanded {
    display: block;
}

/* Price Range Slider */
.price-range-container {
    padding: 0 4px;
}

.price-range-slider {
    position: relative;
    height: 6px;
    background: #e5e5e5;
    border-radius: 3px;
    margin: 20px 0;
}

.price-range-slider::before {
    /* content: '';
    position: absolute;
    left: 0;
    right: 0;
    height: 6px;
    background: #333;
    border-radius: 3px; */
}

.slider-track {
    position: absolute;
    height: 6px;
    background: #333;
    border-radius: 3px;
    top: 0;
    bottom: 0;
}

.price-handle {
    position: absolute;
    width: 18px;
    height: 18px;
    background: #333;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.price-handle.min {
    left: 0;
    transform: translate(-50%, -50%);
}

.price-handle.max {
    right: 0;
    transform: translate(50%, -50%);
}

/* Price Labels */
.price-labels {
    display: flex;
    justify-content: space-between;
    margin-top: 8px;
}

.price-label {
    font-size: 12px;
    color: #666;
}

.price-label.min {
    color: #007bff;
}

.price-label.max {
    color: #007bff;
}

/* Filter Buttons */
.filter-buttons {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.filter-btn {
    flex: 1;
    padding: 10px 16px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
    border: none;
}

.btn-clear {
    background: #fff;
    color: #333;
    border: 1px solid #ddd;
}

.btn-clear:hover {
    background: #f8f9fa;
    border-color: #999;
}

.btn-apply {
    background: #333;
    color: #fff;
    border: 1px solid #333;
}

.btn-apply:hover {
    background: #555;
    border-color: #555;
}

/* Collapsed sections styling */
.filter-section.collapsed .section-title {
    color: #666;
}

.filter-section.collapsed .toggle-btn {
    color: #ff6b35;
}

/* Active price section */
.filter-section.price-section .section-title {
    color: #333;
    font-weight: 500;
}

.filter-section.price-section .toggle-btn {
    background: #f0f0f0;
    color: #333;
    font-weight: bold;
}

/* Size and Color Options */
/* .option-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-top: 12px;
}

.option-item {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s ease;
}

.option-item:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.option-item.selected {
    background: #007bff;
    color: white;
    border-color: #007bff; */
/* } */
.option-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 12px;
}

.option-item {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s ease;
    white-space: nowrap; /* Giữ chữ không bị bể dòng bên trong nút */
}

.option-item:hover {
    border-color: #007bff;
    background: #f8f9fa;
}

.option-item.selected {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

/* Product Card Styles */
    .product-card {
        background: white;
        border-radius: 20px;
        width: 250px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }

    .product-image-container {
        position: relative;
        padding-top: 120%;
        overflow: hidden;
        background: #f8f9fa;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 140px;
        justify-content: space-between;
    }

    .product-name {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .add-to-cart-btn {
        background: linear-gradient(45deg, #ff6b6b, #ee5a52);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 15px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(45deg, #ee5a52, #ff6b6b);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
    }


.main-layout {
    display: flex;
    align-items: flex-start;
    flex-wrap: nowrap;
}

.filter-container {
    flex-shrink: 0;
    width: 280px;
}

.flex-1 {
    flex-grow: 1;
    min-width: 0; /* Prevents overflow issues */
}

.price-input-boxes {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.price-input-boxes input {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Responsive */
@media (max-width: 768px) {
    .main-layout {
        flex-direction: column;
    }
    
    .filter-container {
        width: 100%;
        margin-bottom: 20px;
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
}


/* Product Grid Styles */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        margin-bottom: 60px;
    }

    @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }

</style>

<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Sản phẩm</h1>
        <p class="text-gray-600">Khám phá bộ sưu tập thời trang cao cấp của chúng tôi</p>
    </div>

    <div class="flex gap-8 main-layout">
        <!-- Filters Sidebar -->
        <div class="filter-container">
            <form method="POST" action="{{ route('itemFilter') }}">
                @csrf
                @method('POST')
                <!-- Size Section -->
                <div class="filter-section collapsed">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Size</h4>
                        <div class="toggle-btn">+</div>
                    </div>
                    <div class="section-content">
                        <div class="option-grid">
                            <div class="option-item" onclick="alertC(this)">XS</div>
                            <div class="option-item" onclick="alertC(this)">S</div>
                            <div class="option-item" onclick="alertC(this)">M</div>
                            <div class="option-item" onclick="alertC(this)">L</div>
                            <div class="option-item" onclick="alertC(this)">XL</div>
                            <div class="option-item" onclick="alertC(this)">XXL</div>
                        </div>
                    </div>
                </div>
                <div class="filter-section">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Danh mục</h4>
                        <div class="toggle-btn">+</div>
                    </div>
                    <div class="section-content expanded">
                        <select name="category" style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="">Tất cả</option>
                            @foreach($categories as $index => $category)
                                @if($index === 0)
                                    @continue
                                @endif
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                


                <!-- Price Section (Expanded) -->
                <div class="filter-section price-section">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Mức giá</h4>
                        <div class="toggle-btn expanded">−</div>
                    </div>
                    <div class="section-content expanded">
                        <div class="price-range-container">
                            <div class="price-input-boxes" style="display: flex; gap: 10px; margin-top: 10px;">
                                <input type="number" name="minPriceInput" id="minPriceInput" min="0" max="10000000" value="0" style="flex: 1; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;">
                                <input type="number" name="maxPriceInput" id="maxPriceInput" min="0" max="10000000" value="1000000" style="flex: 1; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="filter-section price-section">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Sắp xếp giá</h4>
                        <div class="toggle-btn expanded">+</div>
                    </div>
                    <div class="section-content expanded" style="margin-top: 10px;">
                        <select name="sortPrice" style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="asc" selected>Giá thấp đến cao</option>
                            <option value="desc">Giá cao đến thấp</option>
                        </select>
                    </div>
                </div>

                <!-- Discount Section -->
                <!-- <div class="filter-section collapsed">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Mức chiết khấu</h4>
                        <div class="toggle-btn">+</div>
                    </div>
                    <div class="section-content">
                        <div class="option-grid">
                            <div class="option-item" onclick="toggleOption(this)">10%</div>
                            <div class="option-item" onclick="toggleOption(this)">20%</div>
                            <div class="option-item" onclick="toggleOption(this)">30%</div>
                            <div class="option-item" onclick="toggleOption(this)">50%</div>
                        </div>
                    </div>
                </div> -->

                <!-- Advanced Section -->
                <div class="filter-section collapsed">
                    <div class="section-header" onclick="toggleSection(this)">
                        <h4 class="section-title">Nâng cao</h4>
                        <div class="toggle-btn">+</div>
                    </div>
                    <div class="section-content">
                        <div class="option-grid">
                            <!-- <div class="option-item" onclick="toggleOption(this)">Mới nhất</div>
                            <div class="option-item" onclick="toggleOption(this)">Bán chạy</div> -->
                            <div class="option-item" onclick="selectSortOption(this, 'newest')">Mới nhất</div>
                            <div class="option-item" onclick="selectSortOption(this, 'bestseller')">Bán chạy</div>

                            <input type="hidden" name="sortOption" id="sortOption" value="">
                        </div>
                    </div>
                </div>

                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button class="filter-btn btn-apply" type="submit">LỌC</button>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="flex-1"  style="margin-left: 10px;">
            <!-- Sort Options -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">Hiển thị {{ $productCount }} trong số {{ $allCount }} sản phẩm</p>
                
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 products-grid"">
                <!-- Sample Products -->
                @foreach($products as $item)
                <div class="product-card mt-5">
                    <div class="product-image-container">
                        <a href="{{ route('showcus', $item->id) }}">
                            <img src="{{ asset('storage/images/' . $item->product_image_url) }}" alt="{{ $item->product_name }}" class="product-image" width="250px">
                        </a>
                        
                        <!-- @php
                            $discountPercent = rand(min: 30, max: 40);
                            $originalPrice = $item->product_price;
                            $fakeDiscountPrice = $originalPrice/(1-$discountPercent/100);
                        @endphp -->
                        <span class="badge bg-danger position-absolute" style="top: 10px; right: 10px; font-size: 0.75rem; padding: 5px 8px; border-radius: 15px;">GIẢM GIÁ</span>
                    </div>
                    <div class="product-info">
                        <h5 class="product-name">{{ \Illuminate\Support\Str::limit($item->product_name, 50) }}</h5>
                        <div class="product-footer">
                            <div>
                                <span class="product-price">{{ number_format($item->product_price, 0) }}đ</span>
                                <br>
                                <small class="text-muted text-decoration-line-through ms-2">{{ number_format($item->product_price*2, 0) }}đ</small>
                            </div>
                            <form method="get" action="{{ route('addToCart', $item->id) }}">
                                <input type="hidden" value="1" name="inputQuantity" id="inputQuantity" min="1" max="999">
                                <button class="add-to-cart-btn" type="submit">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script>
// Toggle section expand/collapse
function toggleSection(header) {
    const section = header.parentElement;
    const content = section.querySelector('.section-content');
    const toggleBtn = section.querySelector('.toggle-btn');
    
    if (content.classList.contains('expanded')) {
        content.classList.remove('expanded');
        section.classList.add('collapsed');
        section.classList.remove('price-section');
        toggleBtn.textContent = '+';
        toggleBtn.classList.remove('expanded');
    } else {
        content.classList.add('expanded');
        section.classList.remove('collapsed');
        if (section.querySelector('.section-title').textContent === 'Mức giá') {
            section.classList.add('price-section');
        }
        toggleBtn.textContent = '−';
        toggleBtn.classList.add('expanded');
    }
}

function selectOnlyOne(element, groupName) {
    function selectOnlyOne(element, group) {
    const parent = element.parentElement;
    
    // Bỏ selected của tất cả option trong cùng nhóm
    parent.querySelectorAll('.option-item').forEach(item => {
        item.classList.remove('selected');
    });

    // Thêm selected cho phần tử được bấm
    element.classList.add('selected');
}
}


function toggleOption(element, inputName = null) {
    element.classList.toggle('selected');

    if (inputName) {
        const value = element.getAttribute('data-value');
        if (element.classList.contains('selected')) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = inputName;
            hiddenInput.value = value;
            hiddenInput.classList.add('hidden-category-' + value);
            document.querySelector('form').appendChild(hiddenInput);
        } else {
            document.querySelectorAll('.hidden-category-' + value).forEach(el => el.remove());
        }
    }
}
function alertC(element) {
    alert('Tính năng đang được phát triển');
}
function selectSortOption(element, value) {
    document.querySelectorAll('.option-item').forEach(item => {
        item.classList.remove('selected');
    });

    element.classList.add('selected');
    document.getElementById('sortOption').value = value;
}

// Price range functionality
let minValue = 0;
let maxValue = 10000000;
let isDragging = false;
let currentHandle = null;

// const slider = document.getElementById('priceSlider');
const slider = document.getElementById('sliderTrack');
const minHandle = document.getElementById('minHandle');
const maxHandle = document.getElementById('maxHandle');
const minPriceLabel = document.getElementById('minPrice');
const maxPriceLabel = document.getElementById('maxPrice');

function formatPrice(value) {
    return new Intl.NumberFormat('vi-VN').format(value) + 'đ';
}

function updatePriceLabels() {
    minPriceLabel.textContent = formatPrice(minValue);
    maxPriceLabel.textContent = formatPrice(maxValue);
}

function updateHandlePositions() {
    const minPercent = (minValue / 10000000) * 100;
    const maxPercent = (maxValue / 10000000) * 100;
    
    minHandle.style.left = minPercent + '%';
    maxHandle.style.left = maxPercent + '%';

    slider.style.left = minPercent + '%';
    slider.style.width = (maxPercent - minPercent) + '%';
}

// Mouse events for dragging
minHandle.addEventListener('mousedown', (e) => {
    isDragging = true;
    currentHandle = 'min';
    e.preventDefault();
});

maxHandle.addEventListener('mousedown', (e) => {
    isDragging = true;
    currentHandle = 'max';
    e.preventDefault();
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;

    const rect = slider.getBoundingClientRect();
    const percent = Math.max(0, Math.min(100, ((e.clientX - rect.left) / rect.width) * 100));
    const value = Math.round((percent / 100) * 10000000);

    if (currentHandle === 'min') {
        minValue = Math.min(value, maxValue); // Clamp minValue to maxValue
    } else if (currentHandle === 'max') {
        maxValue = Math.max(value, minValue); // Clamp maxValue to minValue
    }

    updateHandlePositions();
    updatePriceLabels();
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    currentHandle = null;
});

// Filter functions
function clearFilters() {
    // Reset price range
    minValue = 0;
    maxValue = 10000000;
    updateHandlePositions();
    updatePriceLabels();
    
    // Clear all selected options
    document.querySelectorAll('.option-item.selected').forEach(item => {
        item.classList.remove('selected');
    });
    
    // Reset all sections to collapsed except price
    document.querySelectorAll('.filter-section').forEach(section => {
        const content = section.querySelector('.section-content');
        const toggleBtn = section.querySelector('.toggle-btn');
        const title = section.querySelector('.section-title').textContent;
        
        if (title !== 'Mức giá') {
            content.classList.remove('expanded');
            section.classList.add('collapsed');
            section.classList.remove('price-section');
            toggleBtn.textContent = '+';
            toggleBtn.classList.remove('expanded');
        }
    });
}

function applyFilters() {
    // Get selected options
    const selectedOptions = [];
    document.querySelectorAll('.option-item.selected').forEach(item => {
        selectedOptions.push(item.textContent);
    });
    
    console.log('Applying filters:', {
        options: selectedOptions,
        minPrice: minValue,
        maxPrice: maxValue
    });
    
    // Show alert with filter info
    let filterInfo = `Bộ lọc đã áp dụng:\n`;
    if (selectedOptions.length > 0) {
        filterInfo += `Tùy chọn: ${selectedOptions.join(', ')}\n`;
    }
    filterInfo += `Giá: ${formatPrice(minValue)} - ${formatPrice(maxValue)}`;
    
    alert(filterInfo);
}

// Initialize
updateHandlePositions();
updatePriceLabels();
</script>
@endsection
