<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>

    <style>
        body {
            font-family: Arial;
            max-width: 800px;
            margin: 20px auto;
        }

        header, .produk {
            padding: 15px;
            margin-bottom: 10px;
            background: #eee;
        }

        header, .produk {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 8px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <header>
        <h2>Toko Alat Tulis</h2>

        <a href="{{ route('keranjang') }}">
            Keranjang ({{ $jumlahItem }})
        </a>
    </header>

    <h3>Daftar barang</h3>

    @foreach ($barangs as $barang)
        <div class="produk">
            <div>
                <strong>{{ $barang->nama }}</strong>
                <p class="harga">
                    Rp {{ number_format($barang->harga, 0, ',', '.') }}
                </p>
                <small>Stok: {{ $barang->stok }}</small>
            </div>

            <form
                action="{{ route('keranjang.tambah', $barang->id) }}"
                method="POST"
            >
                @csrf
                <button
                    type="submit"
                    {{ $barang->stok < 1 ? 'disabled' : '' }}
                >
                    Masukkan ke keranjang
                </button>
            </form>
        </div>
    @endforeach

</body>
</html>