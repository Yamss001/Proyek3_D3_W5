<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <style>
        body {
            font-family: Arial;
            max-width: 800px;
            margin: 20px auto;
        }

        header, .item, .total, .kosong {
            padding: 15px;
            margin-bottom: 10px;
            background: #eee;
        }

        header, .item, .total {
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
        <h2>Keranjang belanja</h2>
        <a href="{{ route('index') }}">Kembali ke toko</a>
    </header>

    @if (count($items) > 0)

        @foreach ($items as $item)
            <div class="item">
                <div>
                    <strong>{{ $item['barang']->nama }}</strong>

                    <p>
                        Rp {{ number_format($item['barang']->harga, 0, ',', '.') }}
                        × {{ $item['jumlah'] }}
                        =
                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="aksi">
                    <form
                        action="{{ route('keranjang.ubah', $item['barang']->id) }}"
                        method="POST"
                    >
                        @csrf
                        <input type="hidden" name="aksi" value="kurang">
                        <button type="submit">−</button>
                    </form>

                    <span>{{ $item['jumlah'] }}</span>

                    <form
                        action="{{ route('keranjang.ubah', $item['barang']->id) }}"
                        method="POST"
                    >
                        @csrf
                        <input type="hidden" name="aksi" value="tambah">
                        <button type="submit">+</button>
                    </form>

                    <form
                        action="{{ route('keranjang.hapus', $item['barang']->id) }}"
                        method="POST"
                    >
                        @csrf
                        <button type="submit" class="hapus">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="total">
            <span>Total</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <form action="{{ route('keranjang.kosongkan') }}" method="POST">
            @csrf
            <button type="submit" class="kosongkan">
                Kosongkan keranjang
            </button>
        </form>

    @else

        <div class="kosong">
            <h3>Keranjang masih kosong</h3>
            <p>Silakan pilih barang dari halaman toko.</p>
            <a href="{{ route('index') }}">Mulai belanja</a>
        </div>

    @endif

</body>
</html>