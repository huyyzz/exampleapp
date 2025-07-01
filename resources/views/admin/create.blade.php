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

                <div id="TheRealOptionContainer">

                    <!-- <button type="button" onclick="addValue(${optionIndex})">➕ Add Value</button> -->
                    
                </div>


                <button type="button" onclick="addOption()">Thêm size</button>

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

        const optionGroup = document.createElement('div');
        optionGroup.classList.add('option-group');
        optionGroup.style.marginBottom = '1em';

        optionGroup.innerHTML = `
            <input type="hidden" name="options[${optionIndex}][name]" placeholder="Size" value="Size" required><br>

            <div id="values-container-${optionIndex}">
                <label>Values:</label><br>
                <input type="text" name="options[${optionIndex}][values][0][name]" placeholder="Small" required>
                <input type="number" step="1000" name="options[${optionIndex}][values][0][price]" placeholder="Giá (VND)" required>
            </div>

            <button type="button" onclick="addValue(${optionIndex})">➕ Add Value</button>
            <hr>
        `;

        container.appendChild(optionGroup);
        optionIndex++;
    }

    function addValue(index) {
        const container = document.getElementById(`values-container-${index}`);
        const count = container.querySelectorAll('input[name^="options[' + index + '][values]"]').length / 2;

        const div = document.createElement('div');
        div.innerHTML = `
            <br><input type="text" name="options[${index}][values][${count}][name]" placeholder="e.g. Medium" required>
            <input type="number" step="0.01" name="options[${index}][values][${count}][price]" placeholder="Giá (VND)" required>
        `;
        container.appendChild(div);
    }


    // function addSku() {
    //     const tbody = document.getElementById('sku-rows');
    //     const html = `
    //         <tr>
    //             <td><input type="text" name="skus[${skuIndex}][sku]" required></td>
    //             <td><input type="number" name="skus[${skuIndex}][price]" required></td>
    //             <td><input type="number" name="skus[${skuIndex}][quantity]" required></td>
    //             <td><input type="text" name="skus[${skuIndex}][options]" placeholder="Size:M,Color:Đỏ"></td>
    //         </tr>
    //     `;
    //     tbody.insertAdjacentHTML('beforeend', html);
    //     skuIndex++;
    // } Skip, tự gen
</script>

@endsection