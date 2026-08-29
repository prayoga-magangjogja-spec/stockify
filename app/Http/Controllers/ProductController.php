<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected StockService $stockService
    ) {
    }

    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products = Product::with([
            'category',
            'supplier',
        ])
            ->orderBy('id', 'asc')
            ->get();

        return view(
            'products.index',
            compact('products')
        );
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view(
            'products.create',
            compact(
                'categories',
                'suppliers'
            )
        );
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
                'unique:products,sku',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'minimum_stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $validated['name'] = trim($validated['name']);
        if (strlen($validated['name']) === 0) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'Nama produk tidak boleh hanya berisi karakter spasi.']);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('products', 'public');
        }

        $validated['image'] = $imagePath;

        try {
            $this->stockService->createProductWithInitialStock(
                $validated,
                auth()->id()
            );
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal membuat produk: ' . $e->getMessage());
        }

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail produk.
     */
    public function show(int $id)
    {
        $product = Product::with([
            'category',
            'supplier',
            'stockTransactions',
        ])->findOrFail($id);

        return view(
            'products.show',
            compact('product')
        );
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view(
            'products.edit',
            compact(
                'product',
                'categories',
                'suppliers'
            )
        );
    }

    /**
     * Mengupdate produk.
     * Stok tidak dapat diubah melalui form edit ini.
     */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
                'unique:products,sku,' . $product->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'minimum_stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'remove_image' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['name'] = trim($validated['name']);
        if (strlen($validated['name']) === 0) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'Nama produk tidak boleh hanya berisi karakter spasi.']);
        }

        $product->category_id = (int) $validated['category_id'];
        $product->supplier_id = (int) $validated['supplier_id'];
        $product->name = $validated['name'];
        $product->sku = $validated['sku'];
        $product->description = $validated['description'] ?? null;
        $product->purchase_price = $validated['purchase_price'];
        $product->selling_price = $validated['selling_price'];
        $product->minimum_stock = (int) $validated['minimum_stock'];

        if ($request->hasFile('image')) {
            // Simpan gambar baru terlebih dahulu sebelum menghapus gambar lama
            $newImagePath = $request
                ->file('image')
                ->store('products', 'public');

            // Hapus gambar lama hanya jika gambar baru berhasil disimpan
            if (
                $product->image &&
                Storage::disk('public')->exists($product->image)
            ) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $newImagePath;
        } elseif ($request->boolean('remove_image')) {
            // Hapus gambar dari form edit
            if (
                $product->image &&
                Storage::disk('public')->exists($product->image)
            ) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = null;
        }

        $product->save();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }

    /**
     * Menghapus produk.
     */
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Relational Guard: Cek apakah produk memiliki histori
        |--------------------------------------------------------------------------
        */
        if ($product->stockTransactions()->exists() || $product->stockOpnames()->exists()) {
            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena memiliki riwayat transaksi stok atau stock opname.'
                );
        }

        if ($product->image) {
            try {
                if (Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
            } catch (\Throwable $e) {
                // Abaikan error hapus file agar tidak memblokir penghapusan produk
            }
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }
}