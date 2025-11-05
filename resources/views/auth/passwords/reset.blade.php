<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password - Dekranasda</title>

  <!-- Tailwind CDN (cara kilat) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { colors: { coklat:'#6B4226','coklat-2':'#8B5E3C' }}}}
  </script>
</head>
<body class="h-screen flex relative">

  <!-- Tombol kembali ke beranda -->
  <div class="absolute top-6 left-6">
    <a href="{{ url('/') }}"
       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-coklat rounded-full hover:bg-coklat-2 transition">
      ← Kembali ke Beranda
    </a>
  </div>

  <!-- Kiri: Form Reset Password -->
  <div class="flex-1 flex flex-col justify-center items-center bg-white px-6">
    <img src="{{ asset('/images/logo.jpg') }}" alt="Logo" class="w-28 mb-6">

    <h2 class="text-2xl font-semibold text-coklat mb-6">Reset your password</h2>

    <form method="POST" action="{{ route('password.update') }}" class="w-full max-w-sm space-y-4">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-coklat">Email</label>
        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus
               class="mt-1 w-full rounded-full border border-coklat px-4 py-2
                      focus:ring-2 focus:ring-coklat-2 focus:outline-none @error('email') ring-2 ring-red-400 border-red-400 @enderror">
        @error('email')
          <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password baru -->
      <div>
        <label for="password" class="block text-sm font-medium text-coklat">Password baru</label>
        <input id="password" type="password" name="password" required
               class="mt-1 w-full rounded-full border border-coklat px-4 py-2
                      focus:ring-2 focus:ring-coklat-2 focus:outline-none @error('password') ring-2 ring-red-400 border-red-400 @enderror">
        @error('password')
          <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Konfirmasi password -->
      <div>
        <label for="password-confirm" class="block text-sm font-medium text-coklat">Konfirmasi password</label>
        <input id="password-confirm" type="password" name="password_confirmation" required
               class="mt-1 w-full rounded-full border border-coklat px-4 py-2 focus:ring-2 focus:ring-coklat-2 focus:outline-none">
      </div>

      <!-- Submit -->
      <button type="submit"
              class="w-full bg-coklat text-white font-semibold rounded-full py-2 hover:bg-coklat-2 transition">
        Reset Password
      </button>
    </form>

    <p class="mt-4 text-sm text-gray-600">
      <a href="{{ route('login') }}" class="text-coklat font-medium hover:underline">Kembali ke login</a>
    </p>
  </div>

  <!-- Kanan: Panel Coklat Tekstur -->
  <div class="flex-1 relative bg-coklat">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/wood-pattern.png')] opacity-20"></div>
    <footer class="absolute bottom-4 left-4 text-white text-xs opacity-80">
      © 2025 Dekranasda Kabupaten Bojonegoro
    </footer>
  </div>
</body>
</html>
