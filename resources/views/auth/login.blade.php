<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Dekranasda</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            biru:   '#7dd3fc',
            'biru-2':'#38bdf8',
            'biru-tex':'#0369a1'
          }
        }
      }
    }
  </script>
</head>
<body class="h-screen flex bg-sky-50">

  <div class="absolute top-6 left-6">
    <a href="{{ route('home') }}"
       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-biru rounded-full hover:bg-biru-2 transition">
      ← Kembali ke Beranda
    </a>
  </div>

  <div class="flex-1 flex flex-col justify-center items-center bg-white/90 px-6">
    <img src="{{ asset('/images/logo.jpg') }}" alt="Logo" class="w-28 mb-6">
    <h2 class="text-2xl font-semibold text-biru-tex mb-6">Welcome back!</h2>

    {{-- GANTI action ke route admin --}}
    <form method="POST" action="{{ route('admin.login.post') }}" class="w-full max-w-sm space-y-4">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-biru-tex/90">Email</label>
        <input id="email" type="email" name="email" placeholder="Email"
               class="mt-1 w-full rounded-full border border-biru/60 bg-white px-4 py-2 focus:ring-2 focus:ring-biru-2/50 focus:outline-none @error('email') border-red-500 @enderror"
               value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="relative">
        <label for="password" class="block text-sm font-medium text-biru-tex/90">Password</label>
        <input id="password" type="password" name="password" placeholder="Password"
               class="mt-1 w-full rounded-full border border-biru/60 bg-white px-4 py-2 pr-10 focus:ring-2 focus:ring-biru-2/50 focus:outline-none @error('password') border-red-500 @enderror"
               required>
        {{-- Tombol Show/Hide --}}
        <button type="button" id="togglePassword"
                class="absolute right-3 top-8 text-biru-tex/70 hover:text-biru-tex focus:outline-none">
          👁️
        </button>

        @error('password')
          <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2 text-biru-tex/80">
          <input type="checkbox" name="remember" class="rounded border-biru/60 focus:ring-biru-2/40">Remember me
        </label>
        <a href="{{ route('home') }}" class="text-biru-tex/80 hover:text-biru-tex underline-offset-2 hover:underline">Forgot password?</a>
      </div>

      <button type="submit"
              class="w-full bg-biru text-sky-950 font-semibold rounded-full py-2 hover:bg-biru-2 transition">
        Login
      </button>
    </form>

    <p class="mt-4 text-sm text-gray-600">
      Don’t have an account?
      <a href="{{ route('home') }}" class="text-biru-tex font-medium hover:underline">Back to Home</a>
    </p>
  </div>

  <div class="flex-1 relative flex items-center justify-center
              bg-gradient-to-br from-sky-50 via-sky-100 to-sky-200">
    <div class="absolute inset-0 opacity-10 pointer-events-none"
         style="background-image:url('https://www.transparenttextures.com/patterns/cubes.png')"></div>

    <footer class="absolute bottom-4 left-4 text-sky-800 text-xs/relaxed opacity-80">
      © {{ date('Y') }} Dekranasda Kabupaten Bojonegoro
    </footer>
  </div>

  <script>
    // Fitur show/hide password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // Ganti icon 👁️ ↔️ 🙈
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });
  </script>
</body>
</html>
