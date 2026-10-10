<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = DB::table('orders')
            ->where('id_user', $user->id_user)
            ->orderByDesc('tanggal_order')
            ->get();

        foreach ($orders as $order) {
            $order->details = DB::table('order_details as od')
                ->join('products as p', 'od.id_barang', '=', 'p.id_barang')
                ->where('od.id_order', $order->id_order)
                ->select(
                    'p.nama_barang',
                    'p.gambar',
                    'od.harga_satuan as harga',
                    'od.jumlah_beli as jumlah'
                )
                ->get();
        }

        return view('orders.index', compact('orders'));
    }
}
