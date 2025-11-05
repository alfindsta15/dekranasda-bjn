<nav class="hidden md:flex items-center gap-6 text-sm">
  <a href="{{ route('home') }}">Beranda</a>
  <a href="{{ route('profil.visimisi') }}">Profil</a>

  <div class="relative group">
    <a href="#" class="hover:text-black">Binaan <span class="ml-0.5">▾</span></a>
    {{-- dropdown opsional --}}
  </div>

  <a href="{{ route('produk.index') }}">Produk</a>
  <a href="{{ route('berita.index') }}">Berita</a>
  <a href="{{ route('kontak') }}">Kontak Kami</a>

  @guest
    <a href="{{ route('login') }}"
       class="inline-flex items-center rounded-lg bg-[#E74B3B] text-white px-4 py-2 hover:opacity-90">
      Masuk
    </a>
  @endguest

  @auth
    <form action="{{ route('logout') }}" method="POST" class="inline">
      @csrf
      <button type="submit"
        class="inline-flex items-center rounded-lg bg-[#E74B3B] text-white px-4 py-2 hover:opacity-90">
        Logout
      </button>
    </form>
  @endauth
</nav>
