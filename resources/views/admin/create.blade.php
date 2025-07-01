@extends('admin.layout')
@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 0 15px;
    }
    
    .form-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 30px;
        border-bottom: none;
        font-size: 1.4rem;
        font-weight: 600;
        text-align: center;
    }
    
    .form-body {
        padding: 40px 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 0.95rem;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background-color: #ffffff;
    }
    
    .form-control:hover {
        border-color: #d1d5db;
        background-color: #ffffff;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }
    
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #fafafa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background-color: #ffffff;
    }
    
    .form-select:hover {
        border-color: #d1d5db;
        background-color: #ffffff;
    }
    
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .file-input {
        padding: 12px 16px;
        border: 2px dashed #e5e7eb;
        border-radius: 8px;
        background-color: #fafafa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .file-input:hover {
        border-color: #667eea;
        background-color: #f8faff;
    }
    
    .submit-btn {
        width: 100%;
        padding: 15px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .submit-btn:active {
        transform: translateY(0);
    }
    
    .alert {
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        border: none;
    }
    
    .alert-danger {
        background-color: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
    }
    
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .alert li {
        margin-bottom: 5px;
    }
    
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .form-col {
        flex: 1;
    }
    
    /* Size Selection Styling */
    .size-options-section {
        background: #f8faff;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }
    
    .size-options-section:hover {
        border-color: #d1d5db;
        background-color: #ffffff;
    }
    
    .size-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .size-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .add-size-btn {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .add-size-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
    }
    
    .add-size-btn:active {
        transform: translateY(0);
    }
    
    .option-group {
        background: #ffffff;
        border: 2px solid #f3f4f6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        animation: slideIn 0.4s ease-out;
    }
    
    .option-group:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .size-values-container {
        margin-top: 15px;
    }
    
    .size-values-header {
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .size-value-row {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        align-items: center;
        padding: 12px;
        background: #f9fafb;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .size-value-row:hover {
        background: #f3f4f6;
    }
    
    .size-value-input {
        flex: 1;
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
    }
    
    .size-value-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .price-input {
        flex: 1;
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #ffffff;
    }
    
    .price-input:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
    
    .add-value-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 10px;
    }
    
    .add-value-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .size-divider {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, #e5e7eb 0%, #d1d5db 50%, #e5e7eb 100%);
        margin: 20px 0;
        opacity: 0.6;
    }
    
    .empty-state {
        text-align: center;
        padding: 30px 20px;
        color: #6b7280;
        font-style: italic;
    }
    
    .empty-state i {
        font-size: 2rem;
        margin-bottom: 10px;
        opacity: 0.5;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            margin: 20px auto;
            padding: 0 10px;
        }
        
        .form-body {
            padding: 30px 20px;
        }
        
        .form-header {
            padding: 20px;
            font-size: 1.2rem;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .size-options-section {
            padding: 20px 15px;
        }
        
        .size-section-header {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        
        .size-value-row {
            flex-direction: column;
            gap: 8px;
        }
        
        .size-value-input,
        .price-input {
            width: 100%;
        }
    }
    
    /* Animation */
    .form-card {
        animation: slideUp 0.5s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Input placeholder styling */
    .form-control::placeholder,
    .size-value-input::placeholder,
    .price-input::placeholder {
        color: #9ca3af;
        opacity: 1;
    }
    
    /* Focus states for better accessibility */
    .add-size-btn:focus,
    .add-value-btn:focus {
        outline: 2px solid #667eea;
        outline-offset: 2px;
    }
</style>

<div class="form-container">
    <div class="card form-card">
        <div class="card-header form-header">
            <i class="fas fa-plus-circle"></i> Tạo Sản Phẩm Mới
        </div>
        <div class="card-body form-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Có lỗi xảy ra:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form id="form" method="post" action="{{ route('Cloths.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="product_name" class="form-label">
                        <i class="fas fa-tag"></i> Tên Sản Phẩm
                    </label>
                    <input type="text" 
                           class="form-control" 
                           name="product_name" 
                           id="product_name"
                           placeholder="Nhập tên sản phẩm..."
                           required/>
                </div>

                <div class="form-group">
                    <label for="product_description" class="form-label">
                        <i class="fas fa-align-left"></i> Mô Tả Sản Phẩm
                    </label>
                    <textarea form="form" 
                              name="product_description" 
                              id="product_description"
                              class="form-control form-textarea"
                              placeholder="Nhập mô tả chi tiết sản phẩm..."
                              rows="4"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="category_id" class="form-label">
                                <i class="fas fa-list"></i> Danh Mục
                            </label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="1" selected>Không danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_image_url" class="form-label">
                        <i class="fas fa-image"></i> Hình Ảnh Sản Phẩm
                    </label>
                    <input type="file" 
                           class="form-control file-input" 
                           name="product_image_url[]"
                           id="product_image_url"
                           accept="image/*"
                           multiple/>
                </div>

                <div class="size-options-section">
                    <div class="size-section-header">
                        <div class="size-section-title">
                            <i class="fas fa-rulers"></i> Tùy Chọn Size & Giá
                        </div>
                        <button type="button" class="add-size-btn" onclick="addOption()">
                            <i class="fas fa-plus"></i> Thêm Size
                        </button>
                    </div>
                    
                    <div id="TheRealOptionContainer">
                        <div class="empty-state">
                            <i class="fas fa-tshirt"></i>
                            <p>Chưa có size nào. Nhấn "Thêm Size" để bắt đầu thêm các tùy chọn size và giá.</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Tạo Sản Phẩm
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let optionIndex = 0;

    function addOption() {
        const container = document.getElementById('TheRealOptionContainer');
        
        // Hide empty state if it exists
        const emptyState = container.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        const optionGroup = document.createElement('div');
        optionGroup.classList.add('option-group');

        optionGroup.innerHTML = `
            <input type="hidden" name="options[${optionIndex}][name]" placeholder="Size" value="Size" required>

            <div id="values-container-${optionIndex}" class="size-values-container">
                <div class="size-values-header">
                    <i class="fas fa-list-ul"></i> Danh sách Size:
                </div>
                <div class="size-value-row">
                    <input type="text" name="options[${optionIndex}][values][0][name]" placeholder="Ví dụ: S, M, L..." class="size-value-input" required>
                    <input type="number" step="1000" name="options[${optionIndex}][values][0][price]" placeholder="Giá (VND)" class="price-input" required>
                </div>
            </div>

            <button type="button" class="add-value-btn" onclick="addValue(${optionIndex})">
                <i class="fas fa-plus"></i> Thêm Size Khác
            </button>
            <hr class="size-divider">
        `;

        container.appendChild(optionGroup);
        optionIndex++;
    }

    function addValue(index) {
        const container = document.getElementById(`values-container-${index}`);
        const count = container.querySelectorAll('input[name^="options[' + index + '][values]"]').length / 2;

        const div = document.createElement('div');
        div.classList.add('size-value-row');
        div.innerHTML = `
            <input type="text" name="options[${index}][values][${count}][name]" placeholder="Ví dụ: XL, XXL..." class="size-value-input" required>
            <input type="number" step="1000" name="options[${index}][values][${count}][price]" placeholder="Giá (VND)" class="price-input" required>
        `;
        container.appendChild(div);
    }
</script>

@endsection