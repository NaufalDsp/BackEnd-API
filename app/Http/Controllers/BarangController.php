<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Tag;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('tags')->orderBy('name', 'asc')->get();
        return view('barang.barang', compact('barang'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get(); // Ambil semua kategori
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('barang.barang-add', compact('kategoris','tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs',
            'id_kategori' => 'required|exists:kategoris,id_kategori', // Validasi menggunakan id_kategori
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'stock' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|max:1000',
            'tags' => 'nullable|array', // Validasi input tags
            'tags.*' => 'exists:tags,id_tag', // Validasi setiap tag
        ]);
    
        $input = $request->all();
    
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        // Simpan barang ke database
        $barang = Barang::create($input);
    
        // Sinkronisasi tags
        if (!empty($request->tags)) {
            $barang->tags()->sync($request->tags);
        }
    
        Alert::success('Success', 'Barang has been saved!');
        return redirect('/barang');
    }
    

    public function edit($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('barang.barang-edit', compact('barang', 'kategoris','tags'));
    }

    public function update(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
    
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
    
        if ($request->hasFile('image')) {
            if ($barang->image) {
                $oldImagePath = public_path('images/' . $barang->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $image = $request->file('image');
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        } else {
            $validated['image'] = $barang->image;
        }
    
        $barang->update($validated);
    
        // Sinkronisasi tags
        if (!empty($request->tags)) {
            $barang->tags()->sync($request->tags);
        } else {
            $barang->tags()->detach(); // Hapus semua tags jika tidak ada input
        }
    
        Alert::info('Success', 'Barang has been updated!');
        return redirect('/barang');
    }
    
    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);

        if ($barang->image) {
            $imagePath = public_path('images/' . $barang->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $barang->delete();

        Alert::success('Deleted', 'Barang has been deleted!');
        return redirect('/barang');
    }

}