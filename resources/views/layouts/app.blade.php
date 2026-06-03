<!DOCTYPE html>
<html lang="en" class="scroll-smooth"> {{-- Tambahkan class scroll-smooth di sini --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STS. — Seventy Seven Streetwear</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #000;
            transition: width 0.3s ease;
        }

        /* State Active */
        .nav-link.text-zinc-950::after {
            width: 100%;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased font-sans">

    @include('layouts.navigation')

    <main class="pt-20">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-zinc-50 py-20 border-t border-zinc-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black italic uppercase mb-6">STS<span class="text-zinc-200">WORLD</span></h2>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-zinc-400">2026 Archive — Seventy Seven
                Essentials</p>
        </div>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

        window.addEventListener('scroll', () => {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-zinc-950');
                link.classList.add('text-zinc-400');
                if (link.getAttribute('data-section') === current) {
                    link.classList.remove('text-zinc-400');
                    link.classList.add('text-zinc-950');
                }
            });

            mobileNavLinks.forEach(link => {
                link.classList.remove('text-zinc-950');
                link.classList.add('text-zinc-400');
                if (link.getAttribute('data-section') === current) {
                    link.classList.remove('text-zinc-400');
                    link.classList.add('text-zinc-950');
                }
            });
        });
    });
</script>

</html>
