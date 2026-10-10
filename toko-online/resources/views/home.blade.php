<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Toko Online</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>Toko Online</h1>

        <nav>
            @auth
                <span>Halo, {{ Auth::user()->nama_lengkap }}</span>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}"
                      method="POST" style="display:none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        <h2>Katalog Produk</h2>
        <p>Pilih perlengkapan sekolah yang kamu butuhkan.</p>

        <div class="product-grid">
            @forelse ($products as $product)
                <div class="product-card">

                    @if ($product->gambar)
                        <img
                            src="{{ asset('images/' . $product->gambar) }}"
                            alt="{{ $product->nama_barang }}"
                        >
                    @endif

                    <h3>{{ $product->nama_barang }}</h3>

                    <p class="price">
                        Rp{{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                    
                    <p class="stock">
                        Stok: {{ $product->stok }}
                    </p>

                    @if ($product->stok > 0)
                        <p>Tersedia</p>
                    @else
                        <p>Stok habis</p>
                    @endif
                    @if ($product->stok > 0)
                    @auth
                            <form action="{{ route('cart.add', $product->id_barang) }}" method="POST">
                                @csrf
                                <button type="submit">Tambah ke Keranjang</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login untuk membeli</a>
                        @endauth
                    @else
                        <button disabled>Stok Habis</button>
                    @endif
                </div>
            @empty
                <p>Belum ada produk.</p>
            @endforelse
        </div>
    </main>

</body>
</html>