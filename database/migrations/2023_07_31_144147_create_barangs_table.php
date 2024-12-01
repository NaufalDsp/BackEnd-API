<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('id_barang'); // Primary key
            $table->string('name');
            $table->unsignedBigInteger('id_kategori'); // Foreign key to kategoris
            $table->string('image')->nullable();
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->text('note')->nullable();
            $table->timestamps();

            // Tambahkan constraint foreign key
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
