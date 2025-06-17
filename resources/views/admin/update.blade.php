@extends('admin.layout')
@section('content')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .form-header i {
        font-size: 1.5rem;
    }
    
    .form-body {
        padding: 40px 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 0.95rem;
    }
    
    .form-label i {
        margin-right: 8px;
        color: #374151;
        width: 16px;
        text-align: center;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
        box-sizing: border-box;
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
        min-height: 120px;
        font-family: inherit;
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
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
    
    .quantity-info {
        color: #757575;
        opacity: 0.7;
        font-size: 0.9rem;
        margin-top: 5px;
        font-style: italic;
        display: flex;
        align-items: center;
        gap: 5px;
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
    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-edit"></i>
            Chỉnh Sửa & Cập Nhật Sản Phẩm
        </div>
        
        <div class="form-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form id='form' method="post" action="{{ route('Cloths.update', $cloths->id) }}">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label class="form-label" for="product_name">
                        <i class="fas fa-tag"></i>
                        Tên Sản Phẩm
                    </label>
                    <input type="text" 
                           class="form-control" 
                           id="product_name"
                           name="product_name" 
                           value="{{ $cloths->product_name }}" 
                           placeholder="Nhập tên sản phẩm"
                           required/>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="product_description">
                        <i class="fas fa-align-left"></i>
                        Mô Tả Sản Phẩm
                    </label>
                    <textarea class="form-control form-textarea" 
                              id="product_description"
                              name="product_description" 
                              form="form" 
                              rows="4" 
                              wrap="soft"
                              placeholder="Nhập mô tả chi tiết về sản phẩm">{{ $cloths->product_description }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="inputQuantity">
                        <i class="fas fa-boxes"></i>
                        Thêm Số Lượng Sản Phẩm
                    </label>
                    <input type="number" 
                           class="form-control" 
                           id="inputQuantity"
                           name="inputQuantity" 
                           min="0" 
                           placeholder="Nhập số lượng cần thêm"/>
                    <div class="quantity-info">
                        <i class="fas fa-warehouse"></i>
                        {{ $cloths->QuantityInWareHouse }} sản phẩm có sẵn trong kho
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="product_price">
                        <i class="fas fa-dollar-sign"></i>
                        Giá Sản Phẩm
                    </label>
                    <input type="text" 
                           class="form-control" 
                           id="product_price"
                           name="product_price" 
                           value="{{ $cloths->product_price }}" 
                           placeholder="Nhập giá sản phẩm"
                           required/>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i>
                    Cập Nhật Sản Phẩm
                </button>
            </form>
        </div>
    </div>
</div>
@endsection