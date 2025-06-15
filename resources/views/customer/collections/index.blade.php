@extends('layouts.collections.app')

@section('content')
<div class="bg-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Collections</h1>
            <p class="mt-4 text-lg text-gray-500">Explore our curated collections of premium clothing</p>
        </div>

        <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($collections as $collection)
                <a href="{{ route('collections.show', $collection) }}" class="group">
                    <div class="relative overflow-hidden rounded-lg h-80">
                        @if($collection->image)
                            <img src="{{ $collection->image_url }}" alt="{{ $collection->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No image</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-30 transition-all"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <h3 class="text-2xl font-bold mb-2">{{ $collection->name }}</h3>
                                @if($collection->description)
                                    <p class="text-sm max-w-xs mx-auto">{{ Str::limit($collection->description, 100) }}</p>
                                @endif
                                <div class="mt-4">
                                    <span class="inline-block bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all">
                                        View Collection
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection