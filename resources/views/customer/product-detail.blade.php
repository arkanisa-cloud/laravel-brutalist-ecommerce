@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        {{-- Breadcrumb: Minimalist Style --}}
        <nav class="mb-12">
            <ol class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400">
                <li><a href="{{ route('home') }}" class="hover:text-zinc-950 transition-colors">Beranda</a></li>
                <li>/</li>
                <li><a href="{{ route('customer.shop.index') }}" class="hover:text-zinc-950 transition-colors">Koleksi</a></li>
                <li>/</li>
                <li class="text-zinc-950 italic underline decoration-zinc-200 underline-offset-4">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">

            {{-- Left: Product Image (Column 1-6) --}}
            <div class="lg:col-span-6 space-y-4">
                <div class="relative aspect-square sm:aspect-[4/5] lg:max-h-[600px] bg-zinc-50 rounded-[2.5rem] overflow-hidden border border-zinc-100 group shadow-sm mx-auto">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div
                            class="w-full h-full flex items-center justify-center italic text-zinc-300 font-black uppercase tracking-widest text-xs">
                            Tidak Ada Gambar
                        </div>
                    @endif

                    {{-- Hover Badge --}}
                    <div class="absolute top-6 left-6 sm:top-8 sm:left-8">
                        <span
                            class="px-4 py-2 bg-zinc-950/80 backdrop-blur-md text-white text-[8px] sm:text-[9px] font-black uppercase tracking-[0.3em] rounded-full shadow-xl border border-white/10">
                            {{ $product->category->name }}
                        </span>
                    </div>
                    
                    @if($product->stock > 0 && $product->stock < 5)
                    <div class="absolute bottom-6 left-6 sm:bottom-8 sm:left-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white text-[8px] sm:text-[9px] font-black uppercase tracking-[0.2em] rounded-full shadow-lg animate-bounce">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            Stok Menipis!
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Product Info (Column 7-12) --}}
            <div class="lg:col-span-6 flex flex-col justify-center py-4 lg:py-0">
                <div class="sticky top-32 space-y-8 sm:space-y-10">

                    {{-- Title & Price --}}
                    <div class="space-y-4 sm:space-y-6">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-[0.4em] text-zinc-400 block mb-2">Original Merchandise</span>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tighter uppercase italic leading-[0.9] text-zinc-950">
                                {{ $product->name }}
                            </h1>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 sm:gap-8">
                            <span class="text-2xl sm:text-3xl font-black italic text-zinc-950 tracking-tighter">
                                IDR {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <div class="flex items-center gap-3">
                                @if ($product->stock > 0)
                                    <span class="text-[9px] font-black uppercase tracking-widest px-4 py-1.5 bg-zinc-100 text-zinc-500 rounded-full border border-zinc-200/50">
                                        Persediaan: {{ $product->stock }}
                                    </span>
                                @endif
                                <span class="text-[9px] font-black uppercase tracking-widest px-4 py-1.5 bg-zinc-50 text-zinc-400 rounded-full border border-zinc-100">
                                    {{ $product->weight }}g
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose prose-sm prose-zinc">
                        <h3
                            class="text-[11px] font-black uppercase tracking-[0.2em] text-zinc-400 mb-4 flex items-center gap-2">
                            <span class="w-4 h-[1px] bg-zinc-300"></span> Tentang Produk
                        </h3>
                        <p class="text-zinc-600 font-medium leading-relaxed italic">
                            {{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}
                        </p>
                    </div>

                    {{-- Form Add to Cart --}}
                    <div class="pt-6">
                        @if ($product->stock > 0)
                            <form action="{{ route('customer.cart.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- Qty Selector --}}
                                <div class="flex items-center gap-4">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-zinc-400 italic">Jumlah</label>
                                    <div
                                        class="flex items-center border border-zinc-200 rounded-xl overflow-hidden bg-zinc-50">
                                        <button type="button" onclick="this.nextElementSibling.stepDown()"
                                            class="px-4 py-2 hover:bg-zinc-200 transition-colors text-zinc-600">-</button>
                                        <input type="number" name="qty" value="1" min="1"
                                            max="{{ $product->stock }}"
                                            class="w-12 bg-transparent border-none text-center text-xs font-black focus:ring-0">
                                        <button type="button" onclick="this.previousElementSibling.stepUp()"
                                            class="px-4 py-2 hover:bg-zinc-200 transition-colors text-zinc-600">+</button>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full py-5 bg-zinc-950 text-white text-[11px] font-black uppercase tracking-[0.4em] rounded-2xl shadow-2xl shadow-zinc-950/20 hover:bg-zinc-800 transition-all active:scale-[0.98]">
                                    Masukkan ke Keranjang
                                </button>
                            </form>
                        @else
                            <button
                                class="w-full py-5 bg-zinc-100 text-zinc-400 text-[11px] font-black uppercase tracking-[0.4em] rounded-2xl cursor-not-allowed"
                                disabled>
                                Stok Habis
                            </button>
                        @endif
                    </div>

                    {{-- Shipping Info Small --}}
                    <div class="grid grid-cols-2 gap-4 pt-10 border-t border-zinc-100">
                        <div class="text-[9px] font-bold uppercase tracking-widest text-zinc-400">
                            <p class="text-zinc-950 mb-1 italic font-black">Pengiriman Aman</p>
                            Bekerja sama dengan kurir terpercaya
                        </div>
                        <div class="text-[9px] font-bold uppercase tracking-widest text-zinc-400">
                            <p class="text-zinc-950 mb-1 italic font-black">Transaksi Aman</p>
                            Diverifikasi oleh STS.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if ($relatedProducts->count() > 0)
            <div class="mt-32">
                <h4 class="text-xs font-black uppercase tracking-[0.4em] mb-12 text-center italic">Mungkin Kamu Juga Suka</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach ($relatedProducts as $related)
                        <a href="{{ route('customer.shop.show', $related) }}" class="group">
                            <div class="aspect-[3/4] bg-zinc-50 rounded-2xl overflow-hidden mb-4 border border-zinc-50">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @endif
                            </div>
                            <h5 class="text-[10px] font-bold uppercase text-zinc-950 tracking-tight">{{ $related->name }}
                            </h5>
                            <p class="text-[10px] font-black italic text-zinc-400">IDR
                                {{ number_format($related->price, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
