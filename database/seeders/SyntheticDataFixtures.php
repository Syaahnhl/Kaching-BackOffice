<?php

namespace Kaching\BackOffice\Database\Seeders;

use Kaching\BackOffice\DTO\InventoryItemDTO;
use Kaching\BackOffice\DTO\MenuDTO;

class SyntheticDataFixtures
{
    /**
     * 20 Menu Restoran Sintetis
     * @return MenuDTO[]
     */
    public static function getMenus(): array
    {
        $menus = [
            ['id' => 1, 'name' => 'Nasi Goreng Spesial', 'category' => 'Makanan Utama', 'price' => 28000, 'is_available' => true, 'stock' => 50],
            ['id' => 2, 'name' => 'Mie Goreng Jawa', 'category' => 'Makanan Utama', 'price' => 25000, 'is_available' => true, 'stock' => 40],
            ['id' => 3, 'name' => 'Ayam Bakar Madu', 'category' => 'Makanan Utama', 'price' => 32000, 'is_available' => true, 'stock' => 30],
            ['id' => 4, 'name' => 'Ayam Goreng Lengkuas', 'category' => 'Makanan Utama', 'price' => 30000, 'is_available' => true, 'stock' => 35],
            ['id' => 5, 'name' => 'Bebek Goreng Crispy', 'category' => 'Makanan Utama', 'price' => 38000, 'is_available' => true, 'stock' => 20],
            ['id' => 6, 'name' => 'Sate Ayam Madura (10 tusuk)', 'category' => 'Makanan Utama', 'price' => 26000, 'is_available' => true, 'stock' => 45],
            ['id' => 7, 'name' => 'Sop Buntut Sapi', 'category' => 'Kuah & Sop', 'price' => 55000, 'is_available' => true, 'stock' => 15],
            ['id' => 8, 'name' => 'Soto Betawi Daging', 'category' => 'Kuah & Sop', 'price' => 36000, 'is_available' => true, 'stock' => 25],
            ['id' => 9, 'name' => 'Capcay Seafood', 'category' => 'Sayuran', 'price' => 27000, 'is_available' => true, 'stock' => 25],
            ['id' => 10, 'name' => 'Cah Kangkung Terasi', 'category' => 'Sayuran', 'price' => 18000, 'is_available' => true, 'stock' => 30],
            ['id' => 11, 'name' => 'Es Teh Manis', 'category' => 'Minuman', 'price' => 6000, 'is_available' => true, 'stock' => 200],
            ['id' => 12, 'name' => 'Es Jeruk Segar', 'category' => 'Minuman', 'price' => 9000, 'is_available' => true, 'stock' => 100],
            ['id' => 13, 'name' => 'Kopi Susu Gula Aren', 'category' => 'Minuman', 'price' => 18000, 'is_available' => true, 'stock' => 80],
            ['id' => 14, 'name' => 'Jus Alpukat', 'category' => 'Minuman', 'price' => 16000, 'is_available' => true, 'stock' => 40],
            ['id' => 15, 'name' => 'Tahu Crispy Cabai Garam', 'category' => 'Camilan', 'price' => 15000, 'is_available' => true, 'stock' => 50],
            ['id' => 16, 'name' => 'Tempe Mendoan (4 pcs)', 'category' => 'Camilan', 'price' => 14000, 'is_available' => true, 'stock' => 60],
            ['id' => 17, 'name' => 'Pisang Goreng Keju', 'category' => 'Camilan', 'price' => 16000, 'is_available' => true, 'stock' => 35],
            ['id' => 18, 'name' => 'Bakwan Jagung Renyah', 'category' => 'Camilan', 'price' => 12000, 'is_available' => true, 'stock' => 40],
            ['id' => 19, 'name' => 'Air Mineral Botol 600ml', 'category' => 'Minuman', 'price' => 5000, 'is_available' => true, 'stock' => 150],
            ['id' => 20, 'name' => 'Nasi Putih Pulen', 'category' => 'Tambahan', 'price' => 6000, 'is_available' => true, 'stock' => 120],
        ];

        return array_map(fn($item) => MenuDTO::fromArray($item), $menus);
    }

    /**
     * 5 Meja Sintetis
     */
    public static function getTables(): array
    {
        return [
            ['id' => 1, 'number' => 'Meja 01', 'capacity' => 4, 'status' => 'available'],
            ['id' => 2, 'number' => 'Meja 02', 'capacity' => 2, 'status' => 'occupied'],
            ['id' => 3, 'number' => 'Meja 03', 'capacity' => 6, 'status' => 'available'],
            ['id' => 4, 'number' => 'Meja VIP 1', 'capacity' => 8, 'status' => 'reserved'],
            ['id' => 5, 'number' => 'Lesehan Outdoor', 'capacity' => 10, 'status' => 'available'],
        ];
    }

    /**
     * 10 Supplier Sintetis
     */
    public static function getSuppliers(): array
    {
        return [
            ['id' => 1, 'name' => 'CV Sumber Beras Mulia', 'contact' => '081234567801', 'category' => 'Beras & Sembako'],
            ['id' => 2, 'name' => 'PT Unggas Segar Sejahtera', 'contact' => '081234567802', 'category' => 'Daging Ayam'],
            ['id' => 3, 'name' => 'UD Sayur Mayur Segar', 'contact' => '081234567803', 'category' => 'Sayuran'],
            ['id' => 4, 'name' => 'Toko Bumbu Rempah Nusantara', 'contact' => '081234567804', 'category' => 'Bumbu'],
            ['id' => 5, 'name' => 'CV Daging Sapi Premium', 'contact' => '081234567805', 'category' => 'Daging Sapi'],
            ['id' => 6, 'name' => 'Distributor Telur Ayam Jaya', 'contact' => '081234567806', 'category' => 'Telur'],
            ['id' => 7, 'name' => 'PT Kemasan Pangan Indonesia', 'contact' => '081234567807', 'category' => 'Packaging'],
            ['id' => 8, 'name' => 'Kopi Roastery Priangan', 'contact' => '081234567808', 'category' => 'Kopi & Teh'],
            ['id' => 9, 'name' => 'Depo Minyak Goreng Curah', 'contact' => '081234567809', 'category' => 'Minyak'],
            ['id' => 10, 'name' => 'Grosir Minuman Segar', 'contact' => '081234567810', 'category' => 'Minuman Kemasan'],
        ];
    }

    /**
     * 30 Bahan Baku Sintetis
     * @return InventoryItemDTO[]
     */
    public static function getInventoryItems(): array
    {
        $items = [];
        $rawNames = [
            'Beras Pandan Wangi', 'Beras Ramos', 'Minyak Goreng Sawit', 'Ayam Broiler Fillet',
            'Daging Buntut Sapi', 'Daging Sapi Rawon', 'Bebek Karkas', 'Bawang Merah Lokal',
            'Bawang Putih Honan', 'Cabai Merah Keriting', 'Cabai Rawit Merah', 'Telur Ayam Negeri',
            'Gula Pasir Kristal', 'Gula Merah Aren', 'Kecap Manis Refill', 'Saus Tiram',
            'Garam Dapur Halus', 'Lada Putih Bubuk', 'Tahu Putih Halus', 'Tempe Kotak Kedelai',
            'Kangkung Daun Segar', 'Sawi Hijau Manis', 'Kol Putih Segar', 'Wortel Lokal Manis',
            'Teh Celup Hitam', 'Biji Kopi Arabika', 'Krimer Kental Manis', 'Buah Jeruk Peras',
            'Buah Alpukat Mentega', 'Bumbu Racik Sate'
        ];

        foreach ($rawNames as $idx => $name) {
            $id = $idx + 1;
            $items[] = InventoryItemDTO::fromArray([
                'id' => $id,
                'name' => $name,
                'sku' => sprintf('RAW-%04d', $id),
                'category' => 'Bahan Dapur',
                'current_stock' => rand(5, 50),
                'minimum_stock' => 10,
                'base_uom' => ($id % 3 === 0) ? 'gram' : (($id % 3 === 1) ? 'kg' : 'pcs'),
                'cost_price' => rand(10, 80) * 1000,
            ]);
        }

        return $items;
    }

    /**
     * 10 Staff Sintetis
     */
    public static function getStaff(): array
    {
        return [
            ['id' => 1, 'name' => 'Budi Pratama', 'role' => 'Manager', 'outlet_id' => 1],
            ['id' => 2, 'name' => 'Siti Rahmawati', 'role' => 'Kasir Utama', 'outlet_id' => 1],
            ['id' => 3, 'name' => 'Joko Setiawan', 'role' => 'Kasir Sore', 'outlet_id' => 1],
            ['id' => 4, 'name' => 'Andi Wijaya', 'role' => 'Head Chef', 'outlet_id' => 1],
            ['id' => 5, 'name' => 'Dewi Lestari', 'role' => 'Cook Helper', 'outlet_id' => 1],
            ['id' => 6, 'name' => 'Rian Hidayat', 'role' => 'Barista', 'outlet_id' => 1],
            ['id' => 7, 'name' => 'Doni Saputra', 'role' => 'Waiter', 'outlet_id' => 1],
            ['id' => 8, 'name' => 'Eka Yuliana', 'role' => 'Waitress', 'outlet_id' => 1],
            ['id' => 9, 'name' => 'Fajar Santoso', 'role' => 'Steward', 'outlet_id' => 1],
            ['id' => 10, 'name' => 'Hendra Kurnia', 'role' => 'Inventory Staff', 'outlet_id' => 1],
        ];
    }
}
