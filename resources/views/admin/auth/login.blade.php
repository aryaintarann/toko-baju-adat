<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Toko Baju Adat Bali</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-warm-950 via-warm-900 to-primary-950 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div
                class="w-16 h-16 mx-auto bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <h1 class="font-display text-3xl text-white font-bold">Admin Panel</h1>
            <p class="text-warm-400 mt-2">Toko Baju Adat Bali</p>
        </div>

        <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-8 border border-white/10 shadow-2xl">
            @if($errors->any())
                <div class="bg-accent-500/20 border border-accent-500/30 text-accent-200 px-4 py-3 rounded-xl mb-6 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-warm-200 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-warm-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all"
                        placeholder="admin@tokobajuadat.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-warm-200 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-warm-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all"
                        placeholder="••••••••">
                </div>
                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg hover:shadow-primary-500/40">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-warm-400 hover:text-primary-400 text-sm transition-colors">←
                Kembali ke Website</a>
        </p>
    </div>
</body>

</html>