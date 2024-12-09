<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        
        // Buat user dan authenticate
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_create_barang()
    {
        Storage::fake('public');

        $imageFile = UploadedFile::fake()->image('bread.jpg');

        $response = $this->post('/barang', [
            'name' => 'Roti Tawar',
            'category' => 'Bread',
            'image' => $imageFile,
            'stock' => 100,
            'price' => 15000,
            'note' => 'Fresh bread',
        ]);

        $response->assertRedirect('/barang');

        // Cek seluruh data yang dimasukkan
        $this->assertDatabaseHas('barangs', [
            'name' => 'Roti Tawar',
            'category' => 'Bread',
            'stock' => 100,
            'price' => 15000,
            'note' => 'Fresh bread'
        ]);

        // Periksa apakah file gambar tersimpan
        $barang = Barang::where('name', 'Roti Tawar')->first();
        $this->assertNotNull($barang->image);

        // Pastikan file gambar ada di storage
        Storage::disk('public')->Exists($barang->image);
    }

    public function test_view()
    {
        $barang = Barang::factory()->create();

        $response = $this->get("/barang/{$barang->id_barang}");

        $response->assertStatus(200);
        $response->assertSee($barang->name);
    }

    public function test_update()
    {
        $barang = Barang::factory()->create();

        $response = $this->put("/barang/{$barang->id_barang}", [
            'name' => 'Updated Bread',
            'category' => 'Bread',
            'stock' => 150,
            'price' => 18000,
            'note' => 'Updated fresh bread'
        ]);

        $response->assertRedirect('/barang');
        $this->assertDatabaseHas('barangs', ['name' => 'Updated Bread']);
    }

    public function test_delete()
    {
        $barang = Barang::factory()->create();

        $response = $this->delete("/barang/{$barang->id_barang}");

        $response->assertRedirect('/barang');
        $this->assertDatabaseMissing('barangs', ['id_barang' => $barang->id_barang]);
    }

    public function test_cannot_create_barang_with_empty_name()
    {
        $response = $this->post('/barang', [
            'name' => '',
            'category' => 'Bread',
            'image' => UploadedFile::fake()->image('bread.jpg'),
            'stock' => 100,
            'price' => 15000
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_cannot_update_nonexistent_barang()
    {
        $response = $this->put('/barang/999', [
            'name' => 'Updated Bread',
            'category' => 'Bread',
            'stock' => 150,
            'price' => 18000
        ]);

        $response->assertStatus(404);
    }
    
}