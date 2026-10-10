<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'id_user' => Auth::user()->id_user
        ]);

        $items = $cart->items()->with('product')->get();

        return view('cart', compact('items'));
    }

    public function add(Request $request, $id_barang)
    {
        $product = Product::findOrFail($id_barang);

        if ($product->stok < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $cart = Cart::firstOrCreate([
            'id_user' => Auth::user()->id_user
        ]);

        $item = CartItem::firstOrNew([
            'id_cart' => $cart->id_cart,
            'id_barang' => $id_barang
        ]);

        $jumlahBaru = ($item->exists ? $item->jumlah : 0) + 1;

        if ($jumlahBaru > $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $item->jumlah = $jumlahBaru;
        $item->save();

        return redirect('/cart')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id_cart_item)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $item = $cart->items()
            ->where('id_cart_item', $id_cart_item)
            ->firstOrFail();

        if ($request->jumlah > $item->product->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $item->jumlah = $request->jumlah;
        $item->save();

        return back()->with('success', 'Jumlah barang berhasil diperbarui.');
    }

    public function remove($id_cart_item)
    {
        $cart = Cart::where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $cart->items()
            ->where('id_cart_item', $id_cart_item)
            ->firstOrFail()
            ->delete();

        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
    
}