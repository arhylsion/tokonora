<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama'  => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|numeric|min:0',
        'stok'  => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    $data = $request->only(['nama', 'deskripsi', 'harga', 'stok']);

    // Simpan gambar jika ada
    if ($request->hasFile('image')) {
        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('produk', $fileName, 'public');
        $data['image'] = $fileName;
    }

    Produk::create($data);

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil ditambahkan.');
}

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok'  => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = $request->only(['nama', 'deskripsi', 'harga', 'stok']);

    // Update gambar jika di-upload baru
        if ($request->hasFile('image')) {
        // Hapus gambar lama kalau ada
            if ($produk->image && \Storage::exists('public/produk/' . $produk->image)) {
                \Storage::delete('public/produk/' . $produk->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/produk', $fileName);
            $data['image'] = $fileName;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
    // Hapus gambar jika ada
        if ($produk->image && \Storage::exists('public/produk/' . $produk->image)) {
            \Storage::delete('public/produk/' . $produk->image);
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }


    public function showBuyForm($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.buy', compact('produk'));
    }

    public function processPurchase(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $produk->stok,
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'quantity' => $request->input('quantity'),
        ]);

        $produk->decrement('stok', $request->input('quantity'));

        return redirect()->route('produk.index')->with('success', 'Purchase successful!');
    }

    public function myPurchases()
    {
        $purchases = Purchase::with('produk') // eager load produk info
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('purchase.purchases', compact('purchases'));
    }

}
