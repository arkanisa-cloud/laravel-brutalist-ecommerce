<x-guest-layout>
    <x-slot name="title">Sign In</x-slot>

    <div class="mb-10 text-center">
        <h2 class="text-2xl font-black uppercase italic tracking-tight">Welcome Back</h2>
        <p class="text-xs font-medium text-zinc-400 mt-1">Enter your credentials to access the vault.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label class="text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2 block">Identity
                (Email)</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-5 py-4 bg-zinc-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-zinc-950 transition-all placeholder:text-zinc-300"
                placeholder="name@domain.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex justify-between items-center mb-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-zinc-400">Security Key</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-[9px] font-black uppercase tracking-widest text-zinc-300 hover:text-zinc-950 transition">Forgot?</a>
                @endif
            </div>
            <input type="password" name="password" required
                class="w-full px-5 py-4 bg-zinc-50 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-zinc-950 transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me --}}
        <label class="flex items-center gap-3 cursor-pointer group">
            <input type="checkbox" name="remember"
                class="w-4 h-4 rounded border-zinc-200 text-zinc-950 focus:ring-zinc-950">
            <span
                class="text-[10px] font-black uppercase tracking-widest text-zinc-400 group-hover:text-zinc-950 transition">Keep
                me signed in</span>
        </label>

        <button type="submit"
            class="w-full py-5 bg-zinc-950 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-2xl shadow-xl hover:bg-zinc-800 transition-all active:scale-[0.98]">
            Authorize Access
        </button>

        <div class="pt-6 text-center border-t border-zinc-50">
            <p class="text-xs font-medium text-zinc-400">
                New to STS?
                <a href="{{ route('register') }}"
                    class="font-black text-zinc-950 uppercase tracking-tighter italic border-b border-zinc-950 ml-1">Create
                    Account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
