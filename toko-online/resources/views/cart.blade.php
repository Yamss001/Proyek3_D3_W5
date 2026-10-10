<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>Keranjang Belanja</h1>
        <nav>
            <a href="/">Kembali ke Katalog</a>
        </nav>
    </header>

    <main class="container">
        <h2>Produk di Keranjang</h2>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        @php
            $total = 0;
        @endphp

        @forelse ($items as $item)
            @if ($item->product)
                @php
                    $subtotal = $item->product->harga * $item->jumlah;
                    $total += $subtotal;
                @endphp

                <div class="product-card">
                    <h3>{{ $item->product->nama_barang }}</h3>
                    <p>Harga: Rp{{ number_format($item->product->harga, 0, ',', '.') }}</p>
                    <p>Jumlah: {{ $item->jumlah }}</p>
                    <form action="{{ route('cart.update', $item->id_cart_item) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input
                            type="number"
                            name="jumlah"
                            value="{{ $item->jumlah }}"
                            min="1"
                            max="{{ $item->product->stok }}"
                            required
                        >

                        <button type="submit">Ubah Jumlah</button>
                    </form>

                    <form action="{{ route('cart.remove', $item->id_cart_item) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Hapus</button>
                    </form>
                    <p>Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                </div>
            @endif
        @empty
            <p>Keranjang masih kosong.</p>
        @endforelse

        <h3>Total: Rp{{ number_format($total, 0, ',', '.') }}</h3>
        @if ($items->isNotEmpty())
            <a href="{{ route('checkout.index') }}">
                <button type="button">Lanjut ke Checkout</button>
            </a>
        @endif
    </main>

</body>
</html>