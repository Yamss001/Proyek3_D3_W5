<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['BRG001', 'Buku Tulis', 'Buku tulis 38 lembar', 5000, 50, 'buku.jpg'],
            ['BRG002', 'Pulpen', 'Pulpen tinta biru', 3000, 30, 'pulpen.jpg'],
            ['BRG003', 'Penggaris', 'Penggaris 30 cm', 4000, 25, 'penggaris.jpg'],
            ['BRG004', 'Pensil 2B', 'Pensil untuk menulis', 2500, 40, 'pensil.jpg'],
            ['BRG005', 'Penghapus', 'Penghapus pensil', 1500, 35, 'penghapus.jpg'],
            ['BRG006', 'Spidol', 'Spidol permanen', 6000, 20, 'spidol.jpg'],
            ['BRG007', 'Rautan', 'Rautan pensil', 2000, 25, 'rautan.jpg'],
            ['BRG008', 'Stabilo', 'Penanda teks', 7000, 15, 'stabilo.jpg'],
            ['BRG009', 'Map Plastik', 'Map untuk dokumen', 3500, 30, 'map.jpg'],
            ['BRG010', 'Lem Kertas', 'Lem untuk keperluan sekolah', 4500, 20, 'lem.jpg'],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['id_barang' => $product[0]],
                [
                    'nama_barang' => $product[1],
                    'deskripsi' => $product[2],
                    'harga' => $product[3],
                    'stok' => $product[4],
                    'gambar' => $product[5],
                ]
            );
        }
    }
}