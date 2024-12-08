<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log facade di bagian atas

class ProdukAPIController extends Controller
{
    // Menampilkan semua barang (API)
    public function apiIndex()
    {
        $barang = Barang::with('tags')->orderBy('name', 'asc')->get();
        return response()->json($barang);
    }

    // Menampilkan satu barang berdasarkan ID (API)
    public function apiShow($id_barang)
    {
        $barang = Barang::with('tags')->find($id_barang);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return response()->json($barang);
    }

    // Menyimpan barang baru (API)
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|max:1000',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id_tag',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        $barang = Barang::create($input);

        if (!empty($request->tags)) {
            $barang->tags()->sync($request->tags);
        }

        return response()->json(['message' => 'Barang created successfully', 'data' => $barang], 201);
    }

    //Update APi
    public function apiUpdate(Request $request, $id_barang)
{
    // Log data request yang masuk
    Log::info('Update request received', $request->all());

    $barang = Barang::find($id_barang);

    if (!$barang) {
        Log::error('Barang not found with ID: ' . $id_barang);
        return response()->json(['message' => 'Barang not found'], 404);
    }

    // Log jika barang ditemukan
    Log::info('Barang found:', ['id_barang' => $id_barang]);

    try {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs,name,' . $id_barang . ',id_barang',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|max:1000',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id_tag',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed', ['errors' => $e->errors()]);
        return response()->json(['errors' => $e->errors()], 422);
    }

    // Handle upload gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;

        Log::info('Image uploaded successfully', ['image' => $imageName]);
    }

    $barang->update($validated);

    Log::info('Barang updated successfully', ['id_barang' => $id_barang]);

    return response()->json(['message' => 'Barang updated successfully', 'data' => $barang]);
}

    

    // Menghapus barang (API)
    public function apiDestroy($id_barang)
    {
        $barang = Barang::find($id_barang);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        if ($barang->image) {
            $imagePath = public_path('images/' . $barang->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $barang->delete();

        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
