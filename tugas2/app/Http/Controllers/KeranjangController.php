<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $keranjang = session()->get('keranjang', []);

        $jumlahItem = array_sum($keranjang);

        return view('index', compact(
            'barangs',
            'jumlahItem'
        ));
    }

    public function keranjang()
    {
        $keranjang = session()->get('keranjang', []);
        $barangs = Barang::whereIn('id', array_keys($keranjang))
            ->get();

        $total = 0;
        $items = [];

        foreach ($barangs as $barang) {
            $jumlah = $keranjang[$barang->id];
            $subtotal = $barang->harga * $jumlah;

            $items[] = [
                'barang' => $barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];

            $total += $subtotal;
        }

        $jumlahItem = array_sum($keranjang);

        return view('keranjang', compact(
            'items',
            'total',
            'jumlahItem'
        ));
    }

    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        $jumlahSekarang = $keranjang[$id] ?? 0;

        if ($jumlahSekarang < $barang->stok) {
            $keranjang[$id] = $jumlahSekarang + 1;
            session()->put('keranjang', $keranjang);
        }

        return redirect()->back();
    }

    public function ubahJumlah(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|in:tambah,kurang',
        ]);

        $keranjang = session()->get('keranjang', []);
        $barang = Barang::findOrFail($id);

        if (!isset($keranjang[$id])) {
            return redirect()->route('keranjang');
        }

        if ($request->aksi === 'tambah') {
            if ($keranjang[$id] < $barang->stok) {
                $keranjang[$id]++;
            }
        } else {
            $keranjang[$id]--;

            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang');
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        unset($keranjang[$id]);

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');

        return redirect()->route('keranjang');
    }
}