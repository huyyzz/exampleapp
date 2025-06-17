@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manage Products for: {{ $collection->name }}</h1>
        <a href="{{ route('admin.collections.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to Collections
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.collections.products.update', $collection) }}" method="POST">
            @csrf

            <div class="mb-6">
                <p class="text-gray-700 mb-2">Select products to include in this collection:</p>
                <p class="text-sm text-gray-500 mb-4">Products will appear in the order selected.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <div class="flex items-center p-3 border rounded-md {{ in_array($product->id, $collectionProducts) ? 'bg-blue-50 border-blue-200' : '' }}">
                            <input type="checkbox" name="products[]" id="product_{{ $product->id }}" value="{{ $product->id }}" 
                                   {{ in_array($product->id, $collectionProducts) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="product_{{ $product->id }}" class="ml-2 flex-1 cursor-pointer">
                                <div class="flex items-center">
                                    @if($product->primaryImage)
                                        <img src="{{ $product->primaryImage->image_url }}" alt="{{ $product->name }}" class="h-10 w-10 object-cover rounded mr-2">
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $product->formatted_price }}</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Products
                </button>
            </div>
        </form>
    </div>
</div>
@endsection