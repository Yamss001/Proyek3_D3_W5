<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('id_user', Auth::user()->id_user)
            ->first();

        $items = $cart
            ? $cart->items()->with('product')->get()
            : collect();

        return view('checkout', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string'
        ]);

        DB::transaction(function () use ($request) {
            $cart = Cart::where('id_user', Auth::user()->id_user)
                ->firstOrFail();

            $items = $cart->items()->with('product')->get();

            if ($items->isEmpty()) {
                throw new \RuntimeException('Keranjang masih kosong.');
            }

            $total = 0;

            foreach ($items as $item) {
                $product = $item->product;

                if (!$product || $item->jumlah > $product->stok) {
                    throw new \RuntimeException(
                        'Stok produk tidak mencukupi.'
                    );
                }

                $total += $product->harga * $item->jumlah;
            }

            $order = Order::create([
                'id_order' => 'ORD' . strtoupper(Str::random(12)),
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            foreach ($items as $item) {
                $product = $item->product;

                OrderDetail::create([
                    'id_order' => $order->id_order,
                    'id_barang' => $product->id_barang,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => $item->jumlah,
                ]);

                $product->decrement('stok', $item->jumlah);
            }

            $cart->items()->delete();
        });

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}