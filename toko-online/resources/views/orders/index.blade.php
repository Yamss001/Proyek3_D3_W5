
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Riwayat Pemesanan</h1>

        <a href="{{ url('/home') }}">Kembali ke Katalog</a>

        @forelse ($orders as $order)
            <div class="order-card">
                <h3>Pesanan: {{ $order->id_order }}</h3>

                <p>
                    Tanggal:
                    {{ $order->tanggal_order }}
                </p>

                <p>
                    Alamat pengiriman:
                    {{ $order->alamat_pengiriman }}
                </p>

                <h4>Barang yang dipesan</h4>

                @foreach ($order->details as $detail)
                    <div class="order-item">
                        <img
                            src="{{ asset('images/' . $detail->gambar) }}"
                            alt="{{ $detail->nama_barang }}"
                            width="70"
                        >

                        <span>{{ $detail->nama_barang }}</span>
                        <span>{{ $detail->jumlah }} buah</span>

                        <span>
                            Rp{{ number_format(
                                $detail->harga * $detail->jumlah,
                                0, ',', '.'
                            ) }}
                        </span>
                    </div>
                @endforeach

                <h3>
                    Total:
                    Rp{{ number_format($order->total_harga, 0, ',', '.') }}
                </h3>
            </div>
        @empty
            <p>Belum ada riwayat pemesanan.</p>
        @endforelse
    </div>
</body>
</html>
