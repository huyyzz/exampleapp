<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use App\Models\brand;
use App\Models\category;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\collections;
class AdminCollectionController extends Controller
{
    public function index()
    {
        $collections = collections::orderBy('sort_order')->paginate(10);
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:collections',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('collections', 'public');
        }

        collections::create($validated);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection created successfully.');
    }

    public function edit(collections $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, collections $collection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:collections,slug,' . $collection->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            if ($collection->image) {
                Storage::disk('public')->delete($collection->image);
            }
            $validated['image'] = $request->file('image')->store('collections', 'public');
        }

        $collection->update($validated);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection updated successfully.');
    }

    public function destroy(collections $collection)
    {
        // Delete image if exists
        if ($collection->image) {
            Storage::disk('public')->delete($collection->image);
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection deleted successfully.');
    }

    public function products(collections $collection)
    {
        $collectionProducts = $collection->products()->pluck('cloths.id')->toArray();
        $products = Cloth::orderBy('product_name')->get();
        
        return view('admin.collections.products', compact('collection', 'products', 'collectionProducts'));
    }

    public function updateProducts(Request $request, collections $collection)
    {
        $validated = $request->validate([
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);

        $productIds = $validated['products'] ?? [];
        
        // Sync products with pivot data for sort order
        $syncData = [];
        foreach ($productIds as $index => $id) {
            $syncData[$id] = ['sort_order' => $index];
        }
        
        $collection->products()->sync($syncData);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection products updated successfully.');
    }
}
