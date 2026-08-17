<div class="my-8">
    <h3 class="text-xl font-bold mb-4">{{ $title }}</h3>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @foreach($products as $product)
            <div class="border rounded-lg p-4 bg-white shadow-sm">
                <a href="#">
                {{-- <a href="{{ route('products.show', $product->id) }}"> --}}
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
                    <h4 class="mt-2 font-semibold">{{ $product->name }}</h4>
                    <p class="text-gray-600 mt-1">{{ number_format($product->price) }} تومان</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
