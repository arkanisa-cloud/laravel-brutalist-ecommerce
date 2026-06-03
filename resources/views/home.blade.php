@extends('layouts.app')

@section('content')
    {{-- Refined CSS Animation & Utilities --}}
    <style>
        @keyframes subtle-fade-up {
            0% {
                opacity: 0;
                transform: translateY(15px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes infinite-marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-fade-up {
            opacity: 0;
            animation: subtle-fade-up 0.8s cubic-bezier(0.215, 0.610, 0.355, 1) forwards;
        }

        .animate-marquee-slow {
            display: flex;
            width: max-content;
            animation: infinite-marquee 40s linear infinite;
        }

        @keyframes premium-pulse {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(217, 119, 6, 0.3), 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }

            50% {
                box-shadow: 0 0 40px rgba(217, 119, 6, 0.6), 0 25px 50px -12px rgba(0, 0, 0, 0.6);
            }
        }

        .btn-premium {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #0f172a 100%);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            inset: -1px;
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            border-radius: 1rem;
            z-index: -1;
        }

        .btn-premium:hover {
            animation: premium-pulse 2s ease-in-out infinite;
            transform: translateY(-4px) scale(1.02);
            background: linear-gradient(135deg, #374151 0%, #1f2937 50%, #111827 100%);
        }

        .btn-premium-text {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    {{-- High-End Refined Hero Section --}}
    <section id="home"
        class="relative h-[85vh] sm:h-screen flex items-center justify-center bg-white overflow-hidden border-b border-zinc-100 select-none">

        {{-- Kinetic Background: Quiet & Elegant "STS // WORLD WIDE" Marquee --}}
        <div
            class="absolute inset-x-0 top-1/2 -translate-y-1/2 pointer-events-none opacity-[0.02] overflow-hidden whitespace-nowrap z-0">
            <div class="animate-marquee-slow text-[22vw] font-black italic tracking-tighter uppercase text-zinc-950">
                WORLD WIDE • STS WORLD WIDE • STS WORLD WIDE • STS WORLD WIDE •&nbsp;
            </div>
        </div>

        {{-- Core Content Layout --}}
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto space-y-12 sm:space-y-16">

            {{-- Main Premium Typography Hub (The Largest Heading) --}}
            <div class="animate-fade-up space-y-6 sm:space-y-8" style="animation-delay: 350ms;">
                <h1
                    class="text-6xl sm:text-8xl lg:text-[9.5vw] font-black tracking-tighter uppercase italic leading-[0.80] flex flex-col items-center justify-center">
                    <span class="text-zinc-950">SEVENTY</span>
                    <span class="text-zinc-300 tracking-tight">SEVEN<span class="text-zinc-400 font-normal">.</span></span>
                </h1>
                <p class="text-[9px] sm:text-xs font-mono font-bold text-zinc-400 tracking-[0.25em] uppercase">
                    [ STS WORLD WIDE - OFFICIAL STORE ]
                </p>
            </div>

            {{-- Luxury Navigation-Style Action Trigger --}}
            <div class="animate-fade-up pt-4 flex justify-center" style="animation-delay: 550ms;">
                <a href="#products"
                    class="block md:inline-block w-full md:w-auto px-16 py-6 bg-zinc-950 text-white text-xs font-black uppercase tracking-[0.4em] rounded-2xl shadow-2xl hover:bg-zinc-800 hover:-translate-y-1 transition-all duration-300">
                    Cek Best Seller!
                </a>
            </div>

        </div>

        {{-- Subtle Bottom Metric Rail --}}
        <div
            class="absolute bottom-6 inset-x-0 px-8 justify-between items-center text-[9px] font-mono font-bold text-zinc-400 tracking-widest uppercase hidden md:flex">
            <div>LOC: 77.VAULT</div>
            <div>STATUS: OPERATIONAL</div>
        </div>
    </section>
    {{-- Product Section --}}
    <section id="products" class="max-w-7xl mx-auto px-6 py-24 scroll-mt-24">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter">Produk <span
                    class="text-zinc-300">Best Seller</span></h2>
            <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest mt-4">Koleksi hits yang paling banyak
                diburu saat ini.</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            @foreach ($products as $product)
                <div class="group cursor-pointer" onclick="window.location='{{ route('customer.shop.show', $product) }}'">
                    <div
                        class="relative aspect-[3/4] bg-zinc-100 rounded-2xl overflow-hidden mb-6 shadow-sm group-hover:shadow-xl transition-all duration-500">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <h3
                        class="text-xs font-black uppercase text-zinc-950 group-hover:underline underline-offset-4 decoration-2">
                        {{ $product->name }}</h3>
                    <p class="text-[10px] font-bold text-zinc-500 uppercase mt-1 italic">IDR
                        {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('customer.shop.index') }}"
                class="block md:inline-block w-full md:w-auto px-16 py-6 bg-zinc-950 text-white text-xs font-black uppercase tracking-[0.4em] rounded-2xl shadow-2xl hover:bg-zinc-800 hover:-translate-y-1 transition-all duration-300">
                Lihat Semua Produk ➔
            </a>
        </div>
    </section>

    {{-- Superiority Section --}}
    <section id="superiority" class="bg-zinc-950 text-white py-32 scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl md:text-6xl font-black italic uppercase tracking-tighter mb-20 text-center">Standar <span
                    class="text-zinc-700">STS.</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="space-y-4 text-center">
                    <span class="text-5xl font-black italic text-zinc-800">01</span>
                    <h3 class="text-xl font-black uppercase">Bahan Premium</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed uppercase tracking-wider">Menggunakan katun heavyweight
                        24s/16s buat durabilitas tinggi & nyaman dipakai seharian.</p>
                </div>
                <div class="space-y-4 text-center">
                    <span class="text-5xl font-black italic text-zinc-800">02</span>
                    <h3 class="text-xl font-black uppercase">Sablon Berkualitas</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed uppercase tracking-wider">Dicetak manual dengan tinta
                        plastisol top-tier, ngasih tekstur solid dan nggak gampang pecah.</p>
                </div>
                <div class="space-y-4 text-center">
                    <span class="text-5xl font-black italic text-zinc-800">03</span>
                    <h3 class="text-xl font-black uppercase">Potongan Modern</h3>
                    <p class="text-xs text-zinc-400 leading-relaxed uppercase tracking-wider">Siluet boxy fit yang dirancang
                        khusus menyesuaikan tren gaya streetwear masa kini.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="max-w-7xl mx-auto px-6 py-32 scroll-mt-24">
        <div class="text-center mb-16">
            <h2 class="text-5xl md:text-6xl font-black italic uppercase tracking-tighter">Hubungi <span
                    class="text-zinc-300">Kami.</span></h2>
            <p class="text-zinc-500 text-md mt-4 italic">Ada pertanyaan? Kami siap ngebantu kapan aja!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="space-y-6">
                <div class="bg-white border border-zinc-100 rounded-[2rem] p-8 shadow-2xl shadow-zinc-200/70 space-y-6">
                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center flex-shrink-0 text-zinc-950 border border-zinc-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-1">Markas STS</h4>
                            <p class="text-xs font-bold text-zinc-500 leading-relaxed">Jl. Raya Magelang, Sleman<br>Daerah
                                Istimewa Yogyakarta 55281</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center flex-shrink-0 text-zinc-950 border border-zinc-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-1">Telepon /
                                WhatsApp</h4>
                            <p class="text-xs font-bold text-zinc-500 leading-relaxed">+62 812 7777 0077</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center flex-shrink-0 text-zinc-950 border border-zinc-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-1">Email Resmi
                            </h4>
                            <p class="text-xs font-bold text-zinc-500 leading-relaxed">support@sts.worldwide</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-zinc-50 flex items-center justify-center flex-shrink-0 text-zinc-950 border border-zinc-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-zinc-950 mb-1">Jam Operasional
                            </h4>
                            <p class="text-xs font-bold text-zinc-500 leading-relaxed">Senin - Minggu: 09.00 - 21.00 WIB
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full h-64 md:h-80 bg-zinc-100 rounded-[2rem] overflow-hidden shadow-xl shadow-zinc-200/50 border border-zinc-100 relative group">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126438.2854809817!2d110.29395015!3d-7.77884175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59f1d9fa0e53%3A0x8c11e64d7c0bbab!2sSleman%2C%20Sleman%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1680000000000!5m2!1sen!2sid"
                        class="w-full h-full border-0 grayscale opacity-90 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="bg-zinc-50 p-8 md:p-12 rounded-[2.5rem] border border-zinc-100 h-fit">
                <h3 class="text-2xl font-black italic uppercase tracking-tighter mb-8">Kirim <span
                        class="text-zinc-400">Pesan</span></h3>
                <form class="space-y-5">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2 block">Nama
                            Lengkap</label>
                        <input type="text" placeholder="Masukkan namamu..."
                            class="w-full p-4 bg-white border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-zinc-950 transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2 block">Alamat
                            Email</label>
                        <input type="email" placeholder="nama@email.com..."
                            class="w-full p-4 bg-white border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-zinc-950 transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2 block">Pesan
                            Kamu</label>
                        <textarea rows="5" placeholder="Tulisin aja apa yang mau ditanyain..."
                            class="w-full p-4 bg-white border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-zinc-950 transition-all resize-none"></textarea>
                    </div>
                    <button type="button"
                        class="w-full py-5 bg-zinc-950 text-white text-[10px] font-black uppercase tracking-[0.4em] rounded-2xl shadow-xl hover:bg-zinc-800 transition-all mt-4">
                        Kirim Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
