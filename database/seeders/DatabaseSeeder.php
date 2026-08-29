<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(
            ['email' => 'admin@stockify.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
            ]
        );

        $manager = User::updateOrCreate(
            ['email' => 'manager@stockify.test'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('manager123'),
                'role' => 'Manajer Gudang',
            ]
        );

        $staff1 = User::updateOrCreate(
            ['email' => 'staff@stockify.test'],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('staff123'),
                'role' => 'Staff Gudang',
            ]
        );

        $staff2 = User::updateOrCreate(
            ['email' => 'staff2@stockify.test'],
            [
                'name' => 'Siti Rahma',
                'password' => Hash::make('staff123'),
                'role' => 'Staff Gudang',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = [
            [
                'name' => 'Laptop & Komputer',
                'description' => 'Perangkat komputer, laptop, dan perangkat pendukungnya.',
            ],
            [
                'name' => 'Aksesoris Komputer',
                'description' => 'Aksesoris dan perangkat tambahan komputer.',
            ],
            [
                'name' => 'Peralatan Jaringan',
                'description' => 'Perangkat jaringan seperti router, switch, dan kabel.',
            ],
            [
                'name' => 'Peralatan Kantor',
                'description' => 'Peralatan yang digunakan untuk kebutuhan operasional kantor.',
            ],
            [
                'name' => 'ATK',
                'description' => 'Alat tulis dan perlengkapan administrasi.',
            ],
            [
                'name' => 'Penyimpanan Data',
                'description' => 'Media penyimpanan data seperti SSD, HDD, dan flashdisk.',
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            $id = DB::table('categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $categoryIds[$category['name']] = DB::table('categories')
                ->where('name', $category['name'])
                ->value('id');
        }

        /*
        |--------------------------------------------------------------------------
        | SUPPLIERS
        |--------------------------------------------------------------------------
        */

        $suppliers = [
            [
                'name' => 'PT Teknologi Nusantara',
                'address' => 'Jl. Raya Industri No. 15, Jakarta',
                'phone' => '021-5551234',
                'email' => 'sales@teknonusantara.test',
            ],
            [
                'name' => 'CV Sumber Komputer',
                'address' => 'Jl. Ahmad Yani No. 88, Surakarta',
                'phone' => '0271-778899',
                'email' => 'info@sumberkomputer.test',
            ],
            [
                'name' => 'PT Jaringan Digital Indonesia',
                'address' => 'Jl. Gatot Subroto No. 21, Bandung',
                'phone' => '022-4455667',
                'email' => 'sales@jardigital.test',
            ],
            [
                'name' => 'CV Mitra Perkasa',
                'address' => 'Jl. Diponegoro No. 42, Yogyakarta',
                'phone' => '0274-334455',
                'email' => 'mitra@mitraperkasa.test',
            ],
            [
                'name' => 'PT Solusi Office',
                'address' => 'Jl. Pemuda No. 10, Semarang',
                'phone' => '024-6677889',
                'email' => 'order@solusioffice.test',
            ],
        ];

        $supplierIds = [];

        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->updateOrInsert(
                ['name' => $supplier['name']],
                [
                    'address' => $supplier['address'],
                    'phone' => $supplier['phone'],
                    'email' => $supplier['email'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $supplierIds[$supplier['name']] = DB::table('suppliers')
                ->where('name', $supplier['name'])
                ->value('id');
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = [
            [
                'category' => 'Laptop & Komputer',
                'supplier' => 'PT Teknologi Nusantara',
                'name' => 'Laptop ASUS VivoBook 14',
                'sku' => 'LAP-ASU-001',
                'description' => 'Laptop ASUS VivoBook 14 untuk kebutuhan kerja, kuliah, dan operasional kantor.',
                'purchase_price' => 7200000,
                'selling_price' => 7999000,
                'minimum_stock' => 5,
                'stock' => 12,
            ],
            [
                'category' => 'Laptop & Komputer',
                'supplier' => 'CV Sumber Komputer',
                'name' => 'Laptop Lenovo IdeaPad Slim 3',
                'sku' => 'LAP-LNV-001',
                'description' => 'Laptop Lenovo IdeaPad Slim 3 dengan desain ringan untuk kebutuhan produktivitas.',
                'purchase_price' => 6800000,
                'selling_price' => 7499000,
                'minimum_stock' => 5,
                'stock' => 8,
            ],
            [
                'category' => 'Aksesoris Komputer',
                'supplier' => 'CV Sumber Komputer',
                'name' => 'Mouse Logitech M331',
                'sku' => 'MOU-LOG-001',
                'description' => 'Mouse wireless Logitech dengan desain nyaman dan koneksi stabil.',
                'purchase_price' => 210000,
                'selling_price' => 279000,
                'minimum_stock' => 10,
                'stock' => 25,
            ],
            [
                'category' => 'Aksesoris Komputer',
                'supplier' => 'PT Teknologi Nusantara',
                'name' => 'Keyboard Logitech K120',
                'sku' => 'KEY-LOG-001',
                'description' => 'Keyboard USB Logitech untuk penggunaan komputer sehari-hari.',
                'purchase_price' => 125000,
                'selling_price' => 169000,
                'minimum_stock' => 10,
                'stock' => 18,
            ],
            [
                'category' => 'Peralatan Jaringan',
                'supplier' => 'PT Jaringan Digital Indonesia',
                'name' => 'Router TP-Link Archer C6',
                'sku' => 'RTR-TPL-001',
                'description' => 'Router dual-band untuk kebutuhan jaringan kantor dan rumah.',
                'purchase_price' => 520000,
                'selling_price' => 649000,
                'minimum_stock' => 5,
                'stock' => 9,
            ],
            [
                'category' => 'Peralatan Jaringan',
                'supplier' => 'PT Jaringan Digital Indonesia',
                'name' => 'Switch TP-Link 8 Port',
                'sku' => 'SWT-TPL-001',
                'description' => 'Switch jaringan 8 port untuk koneksi perangkat dalam jaringan lokal.',
                'purchase_price' => 230000,
                'selling_price' => 299000,
                'minimum_stock' => 8,
                'stock' => 15,
            ],
            [
                'category' => 'Peralatan Jaringan',
                'supplier' => 'CV Mitra Perkasa',
                'name' => 'Kabel LAN Cat6 10 Meter',
                'sku' => 'LAN-CAT6-001',
                'description' => 'Kabel LAN Cat6 sepanjang 10 meter untuk kebutuhan instalasi jaringan.',
                'purchase_price' => 45000,
                'selling_price' => 65000,
                'minimum_stock' => 15,
                'stock' => 32,
            ],
            [
                'category' => 'Penyimpanan Data',
                'supplier' => 'PT Teknologi Nusantara',
                'name' => 'SSD Kingston NV2 500GB',
                'sku' => 'SSD-KNG-001',
                'description' => 'SSD NVMe 500GB dengan performa tinggi untuk komputer dan laptop.',
                'purchase_price' => 620000,
                'selling_price' => 749000,
                'minimum_stock' => 5,
                'stock' => 11,
            ],
            [
                'category' => 'Penyimpanan Data',
                'supplier' => 'CV Sumber Komputer',
                'name' => 'Flashdisk Sandisk 64GB',
                'sku' => 'FD-SDK-001',
                'description' => 'Flashdisk 64GB untuk kebutuhan penyimpanan dan pemindahan data.',
                'purchase_price' => 85000,
                'selling_price' => 119000,
                'minimum_stock' => 10,
                'stock' => 24,
            ],
            [
                'category' => 'Peralatan Kantor',
                'supplier' => 'PT Solusi Office',
                'name' => 'Printer Epson L3250',
                'sku' => 'PRT-EPS-001',
                'description' => 'Printer multifungsi untuk kebutuhan cetak, scan, dan copy dokumen.',
                'purchase_price' => 2100000,
                'selling_price' => 2499000,
                'minimum_stock' => 3,
                'stock' => 6,
            ],
            [
                'category' => 'ATK',
                'supplier' => 'PT Solusi Office',
                'name' => 'Kertas A4 80gsm',
                'sku' => 'ATK-KRT-001',
                'description' => 'Kertas A4 80gsm untuk kebutuhan administrasi dan pencetakan dokumen.',
                'purchase_price' => 48000,
                'selling_price' => 58000,
                'minimum_stock' => 20,
                'stock' => 45,
            ],
            [
                'category' => 'ATK',
                'supplier' => 'CV Mitra Perkasa',
                'name' => 'Pulpen Ballpoint Hitam',
                'sku' => 'ATK-PEN-001',
                'description' => 'Pulpen ballpoint tinta hitam untuk kebutuhan administrasi sehari-hari.',
                'purchase_price' => 2500,
                'selling_price' => 4000,
                'minimum_stock' => 30,
                'stock' => 75,
            ],
        ];

        $productIds = [];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['sku' => $product['sku']],
                [
                    'category_id' => $categoryIds[$product['category']],
                    'supplier_id' => $supplierIds[$product['supplier']],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'purchase_price' => $product['purchase_price'],
                    'selling_price' => $product['selling_price'],
                    'image' => null,
                    'minimum_stock' => $product['minimum_stock'],
                    'stock' => $product['stock'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $productIds[$product['sku']] = DB::table('products')
                ->where('sku', $product['sku'])
                ->value('id');
        }

        /*
        |--------------------------------------------------------------------------
        | STOCK TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $transactions = [
            [
                'sku' => 'LAP-ASU-001',
                'user_id' => $staff1->id,
                'type' => 'Masuk',
                'quantity' => 10,
                'date' => now()->subDays(12),
                'status' => 'Diterima',
                'notes' => 'Penerimaan stok laptop dari supplier.',
            ],
            [
                'sku' => 'MOU-LOG-001',
                'user_id' => $staff1->id,
                'type' => 'Masuk',
                'quantity' => 30,
                'date' => now()->subDays(10),
                'status' => 'Diterima',
                'notes' => 'Stok mouse baru diterima dari supplier.',
            ],
            [
                'sku' => 'KEY-LOG-001',
                'user_id' => $staff2->id,
                'type' => 'Masuk',
                'quantity' => 20,
                'date' => now()->subDays(9),
                'status' => 'Diterima',
                'notes' => 'Penerimaan keyboard Logitech.',
            ],
            [
                'sku' => 'RTR-TPL-001',
                'user_id' => $staff1->id,
                'type' => 'Masuk',
                'quantity' => 12,
                'date' => now()->subDays(8),
                'status' => 'Diterima',
                'notes' => 'Penerimaan router TP-Link.',
            ],
            [
                'sku' => 'SSD-KNG-001',
                'user_id' => $manager->id,
                'type' => 'Masuk',
                'quantity' => 15,
                'date' => now()->subDays(7),
                'status' => 'Diterima',
                'notes' => 'Restock SSD Kingston NV2.',
            ],
            [
                'sku' => 'LAP-LNV-001',
                'user_id' => $staff2->id,
                'type' => 'Keluar',
                'quantity' => 2,
                'date' => now()->subDays(5),
                'status' => 'Dikeluarkan',
                'notes' => 'Pengeluaran laptop untuk kebutuhan operasional.',
            ],
            [
                'sku' => 'MOU-LOG-001',
                'user_id' => $staff1->id,
                'type' => 'Keluar',
                'quantity' => 5,
                'date' => now()->subDays(4),
                'status' => 'Dikeluarkan',
                'notes' => 'Pengeluaran mouse untuk kebutuhan kantor.',
            ],
            [
                'sku' => 'KRT-ATK-001',
                'user_id' => $staff2->id,
                'type' => 'Keluar',
                'quantity' => 10,
                'date' => now()->subDays(3),
                'status' => 'Dikeluarkan',
                'notes' => 'Pengeluaran kertas untuk administrasi.',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Fix SKU typo for paper transaction
        |--------------------------------------------------------------------------
        */

        $transactions[7]['sku'] = 'ATK-KRT-001';

        foreach ($transactions as $transaction) {
            DB::table('stock_transactions')->insert([
                'product_id' => $productIds[$transaction['sku']],
                'user_id' => $transaction['user_id'],
                'type' => $transaction['type'],
                'quantity' => $transaction['quantity'],
                'date' => $transaction['date'],
                'status' => $transaction['status'],
                'notes' => $transaction['notes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STOCK OPNAMES
        |--------------------------------------------------------------------------
        */

        $opnames = [
            [
                'sku' => 'LAP-ASU-001',
                'user_id' => $manager->id,
                'system_stock' => 12,
                'physical_stock' => 12,
                'difference' => 0,
                'date' => now()->subDays(2),
                'notes' => 'Stok sesuai dengan kondisi fisik.',
            ],
            [
                'sku' => 'MOU-LOG-001',
                'user_id' => $staff1->id,
                'system_stock' => 25,
                'physical_stock' => 24,
                'difference' => -1,
                'date' => now()->subDays(2),
                'notes' => 'Ditemukan selisih satu unit.',
            ],
            [
                'sku' => 'KEY-LOG-001',
                'user_id' => $staff2->id,
                'system_stock' => 18,
                'physical_stock' => 19,
                'difference' => 1,
                'date' => now()->subDays(1),
                'notes' => 'Ditemukan satu unit lebih saat pengecekan.',
            ],
            [
                'sku' => 'RTR-TPL-001',
                'user_id' => $manager->id,
                'system_stock' => 9,
                'physical_stock' => 9,
                'difference' => 0,
                'date' => now()->subDays(1),
                'notes' => 'Stok fisik sesuai dengan sistem.',
            ],
            [
                'sku' => 'ATK-KRT-001',
                'user_id' => $staff1->id,
                'system_stock' => 45,
                'physical_stock' => 43,
                'difference' => -2,
                'date' => now(),
                'notes' => 'Terdapat selisih dua rim saat stock opname.',
            ],
        ];

        foreach ($opnames as $opname) {
            DB::table('stock_opnames')->insert([
                'product_id' => $productIds[$opname['sku']],
                'user_id' => $opname['user_id'],
                'system_stock' => $opname['system_stock'],
                'physical_stock' => $opname['physical_stock'],
                'difference' => $opname['difference'],
                'date' => $opname['date'],
                'notes' => $opname['notes'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}