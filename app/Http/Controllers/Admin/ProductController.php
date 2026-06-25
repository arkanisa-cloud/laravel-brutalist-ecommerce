<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', 
        ]);

        if ($request->hasFile('image')) {
            // Panggil fungsi konversi WebP buatan kita sendiri
            $validated['image'] = $this->convertToWebp($request->file('image'));
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', 
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Panggil fungsi konversi WebP buatan kita sendiri
            $validated['image'] = $this->convertToWebp($request->file('image'));
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Fungsi Helper Native PHP untuk Konversi ke WebP
     */
    private function convertToWebp($file)
    {
        $sourcePath = $file->getPathname();
        $mime = $file->getMimeType();
        $sourceImage = null;

        // 1. Baca gambar ke memori berdasarkan format aslinya
        if ($mime == 'image/jpeg') {
            $sourceImage = imagecreatefromjpeg($sourcePath);
        } elseif ($mime == 'image/png') {
            $sourceImage = imagecreatefrompng($sourcePath);
            
            // Pertahankan transparansi (alpha channel) agar background PNG tidak jadi hitam
            imagepalettetotruecolor($sourceImage);
            imagealphablending($sourceImage, true);
            imagesavealpha($sourceImage, true);
        }

        if ($sourceImage) {
            // 2. Gunakan Output Buffering (ob_start) untuk menangkap hasil konversi dari memori
            ob_start();
            imagewebp($sourceImage, null, 80); // Angka 80 adalah kualitas kompresi (0-100)
            $imageContent = ob_get_clean();
            
            // 3. Bersihkan RAM
            imagedestroy($sourceImage);

            // 4. Simpan menggunakan Storage Laravel agar konsisten dengan ekosistem aplikasi
            $filename = 'products/' . uniqid('sts_') . '.webp';
            Storage::disk('public')->put($filename, $imageContent);

            return $filename;
        }

        // Fallback: Jika PHP gagal mengonversi (misal karena file rusak), jalankan metode bawaan Laravel
        return $file->store('products', 'public');
    }
}