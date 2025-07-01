@extends('admin.layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    .product-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f7fa;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Header Section */
    .product-header {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .product-main {
        display: grid;
        grid-template-columns: 400px 1fr;
        gap: 40px;
        align-items: start;
        margin-bottom: 32px;
    }

    /* Product Image Section */
    .product-image-section {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .product-image {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #e2e8f0;
        background-color: #f8fafc;
    }

    /* Product Info */
    .product-info h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 16px 0;
        line-height: 1.2;
    }

    .product-price {
        font-size: 1.75rem;
        font-weight: 600;
        color: #059669;
        margin-bottom: 8px;
    }

    .product-total {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 16px;
    }

    .product-units {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        padding: 8px 16px;
        border-radius: 24px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 16px;
        border: 1px solid #93c5fd;
    }

    .profitability {
        color: #059669;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 20px;
        padding: 8px 12px;
        background: #ecfdf5;
        border-radius: 8px;
        border-left: 4px solid #059669;
    }

    /* Product Link */
    .product-link {
        background: #f8fafc;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .product-link h4 {
        font-size: 0.95rem;
        color: #374151;
        margin: 0 0 12px 0;
        font-weight: 600;
    }

    .product-link a {
        color: #2563eb;
        text-decoration: none;
        font-size: 0.875rem;
        word-break: break-all;
        display: block;
        padding: 8px 12px;
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .product-link a:hover {
        background: #eff6ff;
        border-color: #3b82f6;
    }

    /* Product Details */
    .product-details {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.95rem;
    }

    .detail-value {
        color: #64748b;
        font-weight: 400;
        font-size: 0.95rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 44px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: 1px solid #2563eb;
    }

    .btn-outline {
        background: #ffffff;
        color: #64748b;
        border: 1px solid #d1d5db;
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: 1px solid #059669;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: #9ca3af;
    }

    /* Description Section */
    .description-section {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .description-section h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1a202c;
        margin: 0 0 16px 0;
    }

    .no-description {
        color: #64748b;
        font-style: italic;
        font-size: 0.95rem;
    }

    /* Tabs Section */
    .tabs-section {
        background: #ffffff;
        border-radius: 16px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .tabs-nav {
        display: flex;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .tab-button {
        padding: 20px 32px;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 500;
        color: #64748b;
        transition: all 0.2s ease;
        border-bottom: 3px solid transparent;
        font-size: 0.95rem;
    }

    .tab-button.active {
        color: #2563eb;
        border-bottom-color: #2563eb;
        background: #ffffff;
    }

    .tab-button:hover:not(.active) {
        color: #374151;
        background: #f1f5f9;
    }

    .tab-content {
        padding: 32px;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Table Styles */
    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .table th {
        background: #f8fafc;
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.9rem;
    }

    .table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #64748b;
        font-size: 0.9rem;
    }

    .table tr:hover {
        background: #f8fafc;
    }

    /* Badges */
    .badge {
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
        margin: 2px;
    }

    .badge-secondary {
        background: #e2e8f0;
        color: #475569;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-warning {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-light {
        background: #f1f5f9;
        color: #475569;
    }

    /* Product Options */
    .product-options .mb-3 {
        margin-bottom: 24px;
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .product-options strong {
        color: #374151;
        font-size: 1rem;
        display: block;
        margin-bottom: 12px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .product-main {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .product-detail-container {
            padding: 16px;
        }
    }

    @media (max-width: 768px) {
        .product-header,
        .description-section,
        .tabs-section {
            padding: 20px;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .tabs-nav {
            flex-wrap: wrap;
        }
        
        .tab-button {
            padding: 16px 20px;
        }
        
        .btn {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 640px) {
        .product-info h1 {
            font-size: 1.5rem;
        }
        
        .product-price {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<div class="product-detail-container">
    <!-- Product Header -->
    <div class="product-header">
        <div class="product-main">
            <!-- Left Side - Product Image & Info -->
            <div class="product-image-section">
                <img src="{{asset('storage/images/'.$cloth->product_image_url)}}" 
                     alt="{{ $cloth->product_name }}" 
                     class="product-image"
                     style="width: 300px; height: 100%; object-fit: cover;">

                <div class="product-link">
                    <h4>Product URL Link to Share</h4>
                    <a href="{{ route('showcus', $cloth->id) }}" target="_blank">
                        {{ route('showcus', $cloth->id) }}
                    </a>
                </div>
            </div>

            <!-- Right Side - Product Details -->
            <div class="product-details">
                <div class="detail-row">
                    <span class="detail-label">Danh mục:</span>
                    <span class="detail-value">{{ $cloth->category->name ?? 'Không danh mục' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Tạo lúc:</span>
                    <span class="detail-value">{{ $cloth->created_at ? $cloth->created_at->format('d/m/Y') : 'N/A' }}</span>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-outline" onclick="shareProduct()">
                <i class="fas fa-share"></i> Chia sẻ
            </button>
            <a href="#" class="btn btn-outline" 
                data-bs-toggle="modal" 
                data-bs-target="#updateStockModal">
                Cập nhật số lượng sản phẩm
            </a>
            <div class="modal fade" 
            id="updateStockModal" 
            tabindex="-1" 
            aria-labelledby="updateStockModalLabel" 
            aria-hidden="true"
            data-bs-backdrop="false"
            data-bs-keyboard="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStockModalLabel">
                            <i class="fas fa-boxes"></i> Cập nhật số lượng sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method="POST" action="{{ route('SkuUpdate') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">SKU</label>
                                <select name="id" class="form-control" required>
                                    @foreach ($cloth->skus as $sku)
                                    <option value="{{ $sku->id }}">{{ $sku->sku }} - Kích cỡ: {{ $sku->skuValues[0]->optionValue->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Thêm số lượng</label>
                                <input type="number" name="quantity" id="stock_quantity" class="form-control" required min="0">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        
                    </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('Cloths.edit',$cloth->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Cập nhật thông tin sản phẩm
            </a>
        </div>
    </div>

    <!-- Description Section -->
    <div class="description-section">
        <h3>Short Description</h3>
        @if($cloth->product_description)
            <p>{{ $cloth->product_description }}</p>
        @else
            <p class="no-description">No product description available</p>
        @endif
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs-nav">
            <button class="tab-button active" onclick="showTab('information')">Product Information</button>
            <button class="tab-button" onclick="showTab('variants')">Product Variants</button>
            <a href="#" class="btn btn-primary btn-outline-primary float-end" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createSize">
                    Thêm size
            </a>
            <div class="modal fade" 
                id="createSize" 
                tabindex="-1" 
                aria-labelledby="createSizeLabel" 
                aria-hidden="true"
                data-bs-backdrop="false"
                data-bs-keyboard="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSizeLabel">
                            <i class="fas fa-boxes"></i> Thêm size
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form method="POST" action="{{ route('SkuCreate') }}">
                        @csrf
                        <div class="modal-body" style="display: none">
                            <div class="mb-3">
                                <label for="price" class="form-label">Thêm số lượng</label>
                                <input type="number" name="cloth_id" id="cloth_id" class="form-control" value="{{ $cloth->id }}" required>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" name="size" id="size" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                        
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <!-- Product Information Tab -->
            <div id="information-tab" class="tab-pane active">
                <div class="product-options">
                    <!-- <h4 style="margin-bottom: 24px; color: #1a202c; font-size: 1.25rem;">Product Options</h4> -->
                    @if($cloth->options && count($cloth->options) > 0)
                        @foreach($cloth->options as $option)
                            <div class="mb-3">
                                <strong>{{ $option->name }}:</strong>
                                <div class="mt-1">
                                    @foreach($option->optionValues as $value)
                                        <span class="badge badge-secondary">
                                            {{ $value->value }}
                                        </span>
                                        @if(isset($value->skuvalue[0]) && isset($value->skuvalue[0]->clothSku))
                                            <span class="badge badge-light">
                                                SKU: {{ $value->skuvalue[0]->clothSku->sku }}
                                            </span>
                                            <span class="badge badge-light">
                                                {{ number_format($value->skuvalue[0]->clothSku->price) }} VND
                                            </span>
                                            <span class="badge badge-{{ $value->skuvalue[0]->clothSku->quantity > 0 ? 'success' : 'danger' }}">
                                                {{ $value->skuvalue[0]->clothSku->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        @endif
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="no-description">No options configured</p>
                    @endif
                </div>
            </div>

            <!-- Product Variants Tab -->
            <div id="variants-tab" class="tab-pane">
                <h4 style="margin-bottom: 24px; color: #1a202c; font-size: 1.25rem;">Product Variants (SKUs)</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cloth->skus && count($cloth->skus) > 0)
                                @foreach($cloth->skus as $sku)
                                    <tr>
                                        <td><strong>{{ $sku->sku }}</strong></td>
                                        <td>{{ number_format($sku->price) }} VNĐ</td>
                                        <td>
                                            <span class="badge badge-{{ $sku->quantity > 10 ? 'success' : ($sku->quantity > 0 ? 'warning' : 'danger') }}">
                                                {{ $sku->quantity }} units
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $sku->quantity > 0 ? 'success' : 'danger' }}">
                                                {{ $sku->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="editSKU()">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center" style="text-align: center; color: #64748b;">No variants available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function showTab(tabName) {
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab pane
    document.getElementById(tabName + '-tab').classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}
function shareProduct() {
    const url = "{{ route('showcus', $cloth->id) }}";
    if (navigator.share) {
        navigator.share({
            title: "{{ $cloth->product_name }}",
            text: "Check out this product",
            url: url
        });
    } else {
        navigator.clipboard.writeText(url).then(() => {
            alert('Product link copied to clipboard!');
        });
    }
}


function editSKU(skuId) {
    alert('Tính lăng tương lai -> disable SKU')
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.tab-button').classList.add('active');
    document.querySelector('.tab-pane').classList.add('active');
});
</script>

@endsection