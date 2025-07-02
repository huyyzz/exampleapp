@extends('admin.layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .product-detail-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .product-header {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .product-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .product-image-section {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .product-image {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid #e9ecef;
    }

    .product-info h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 1.5rem;
        font-weight: 600;
        color: #27ae60;
        margin-bottom: 5px;
    }

    .product-total {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .product-units {
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 10px;
    }

    .profitability {
        color: #27ae60;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .product-link {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .product-link h4 {
        font-size: 0.9rem;
        color: #495057;
        margin-bottom: 8px;
    }

    .product-link a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.85rem;
        word-break: break-all;
    }

    .product-details {
        display: grid;
        gap: 15px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-label {
        font-weight: 500;
        color: #495057;
    }

    .detail-value {
        color: #6c757d;
        font-weight: 400;
    }

    .description-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .description-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .no-description {
        color: #6c757d;
        font-style: italic;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-outline {
        background: white;
        color: #6c757d;
        border: 2px solid #e9ecef;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .tabs-section {
        background: white;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .tabs-nav {
        display: flex;
        border-bottom: 1px solid #e9ecef;
        background: #f8f9fa;
    }

    .tab-button {
        padding: 15px 25px;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 500;
        color: #6c757d;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
    }

    .tab-button.active {
        color: #007bff;
        border-bottom-color: #007bff;
        background: white;
    }

    .tab-content {
        padding: 30px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .stats-section h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        border: 1px solid #e9ecef;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
    }

    .customers-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }

    .customer-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background: white;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .customer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #007bff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .customer-actions {
        display: flex;
        gap: 10px;
    }

    .action-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .action-icon:hover {
        background: #007bff;
        color: white;
    }

    @media (max-width: 768px) {
        .product-main {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .tabs-nav {
            flex-wrap: wrap;
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
                    <h4>Product url link to share</h4>
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
            <p class="no-description">No product description</p>
        @endif
    </div>

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="tabs-nav">
            <button class="tab-button" onclick="showTab('information')">Product Information</button>
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
                                            <span class="badge badge-secondary">
                                                SKU: {{ $value->skuvalue[0]->clothSku->sku }}
                                            </span>
                                            <span class="badge badge-secondary mr-1">
                                                {{ $value->skuvalue[0]->clothSku->price }} VND
                                            </span>
                                            <span class="badge badge-{{ $value->skuvalue[0]->clothSku->quantity > 0 ? 'success' : 'danger' }}">
                                                {{ $value->skuvalue[0]->clothSku->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                            <br>
                                        @endif
                                        @endforeach
                                        
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-description">No options configured</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stock History Tab
            <div id="stock-history-tab" class="tab-pane" style="display: none;">
                <h4>Stock Movement History</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>SKU</th>
                                <th>Action</th>
                                <th>Quantity</th>
                                <th>Remaining Stock</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($stockHistory) && count($stockHistory) > 0)
                                @foreach($stockHistory as $history)
                                    <tr>
                                        <td>{{ $history->created_at->format('M d, Y H:i') }}</td>
                                        <td>{{ $history->sku }}</td>
                                        <td>
                                            <span class="badge badge-{{ $history->action == 'increase' ? 'success' : 'warning' }}">
                                                {{ ucfirst($history->action) }}
                                            </span>
                                        </td>
                                        <td>{{ $history->quantity }}</td>
                                        <td>{{ $history->remaining_stock }}</td>
                                        <td>{{ $history->notes ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No stock history available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div> -->

            <!-- Product Variants Tab -->
            <div id="variants-tab" class="tab-pane" style="display: none;">
                <h4>Product Variants (SKUs)</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                        <!-- <td>
                                            @if(isset($sku->options) && count($sku->options) > 0)
                                                @foreach($sku->options as $key => $value)
                                                    <small class="badge badge-light">{{ $key }}: {{ $value }}</small>
                                                @endforeach
                                            @else
                                                <small class="text-muted">No options</small>
                                            @endif
                                        </td> -->
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
                                    <td colspan="6" class="text-center">No variants available</td>
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
        pane.style.display = 'none';
    });
    
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab pane
    document.getElementById(tabName + '-tab').style.display = 'block';
    
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
