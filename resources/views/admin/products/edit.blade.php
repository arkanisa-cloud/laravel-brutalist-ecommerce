@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.products.index') }}"
                class="text-xs font-black uppercase tracking-widest text-zinc-400 hover:text-zinc-950 transition-colors flex items-center gap-2 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Inventory
            </a>
            <h1 class="text-3xl font-black tracking-tighter text-zinc-950 uppercase italic">Edit Collection</h1>
            <p class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Updating: {{ $product->name }}</p>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm space-y-5">
                        <h2
                            class="text-xs font-black uppercase tracking-[0.2em] text-zinc-400 mb-4 border-b border-zinc-50 pb-2">
                            Information Update</h2>

                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-2 block">Product
                                Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950">
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div>
                                <label
                                    class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-2 block">Category</label>
                                <select name="category_id"
                                    class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-2 block">Price
                                    (IDR)</label>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950">
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-2 block">Weight
                                    (Gram)</label>
                                <input type="number" name="weight" value="{{ old('weight', $product->weight) }}"
                                    class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950">
                            </div>
                        </div>

                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-2 block">Description</label>
                            <textarea name="description" rows="5"
                                class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <h2
                            class="text-xs font-black uppercase tracking-[0.2em] text-zinc-400 mb-4 border-b border-zinc-50 pb-2">
                            Stock Control</h2>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="w-full bg-zinc-50 border-none rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-zinc-950 text-center">
                    </div>

                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <h2
                            class="text-xs font-black uppercase tracking-[0.2em] text-zinc-400 mb-4 border-b border-zinc-50 pb-2">
                            Media</h2>
                        <div class="space-y-4">
                            <div id="image-preview" class="w-full aspect-square bg-zinc-50 rounded-xl overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center italic text-zinc-300 text-[10px] font-black uppercase tracking-widest">
                                        No Media</div>
                                @endif
                            </div>
                            <input type="file" name="image" id="image-input" class="hidden" accept="image/*">
                            <button type="button" onclick="document.getElementById('image-input').click()"
                                class="w-full py-3 bg-zinc-100 hover:bg-zinc-200 text-zinc-600 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">
                                Replace Photo
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-zinc-950 hover:bg-zinc-800 text-white text-xs font-black uppercase tracking-[0.3em] rounded-2xl shadow-xl shadow-zinc-950/20 transition-all">
                        Update Collection
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image-input').onchange = evt => {
            const [file] = evt.target.files
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
            }
        }
    </script>
@endsection
