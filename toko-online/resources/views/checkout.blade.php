<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>Checkout</h1>
        <nav>
            <a href="/cart">Kembali ke Keranjang</a>
        </nav>
    </header>

    <main class="container">
        <h2>Ringkasan Pesanan</h2>

        @if ($errors->any())
            <p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </p>
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
                    <p>Harga satuan:
                        Rp{{ number_format($item->product->harga, 0, ',', '.') }}
                    </p>
                    <p>Jumlah: {{ $item->jumlah }}</p>
                    <p>Subtotal:
                        Rp{{ number_format($subtotal, 0, ',', '.') }}
                    </p>
                </div>
            @endif
        @empty
            <p>Keranjang masih kosong.</p>
        @endforelse

        <h3>Total:
            Rp{{ number_format($total, 0, ',', '.') }}
        </h3>

        @if ($items->isNotEmpty())
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <label for="alamat_pengiriman">
                    Alamat Pengiriman
                </label>

                <textarea
                    id="alamat_pengiriman"
                    name="alamat_pengiriman"
                    rows="4"
                    required
                >{{ old('alamat_pengiriman') }}</textarea>

                <br><br>

                <button type="submit">Buat Pesanan</button>
            </form>
        @endif
    </main>

</body>
</html>