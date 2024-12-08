@extends('template.main')
@section('title', 'Detail Barang')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/barang">Barang</a></li>
                            <li class="breadcrumb-item active">Detail Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Barang</h3>
                                <div class="text-right">
                                    <a href="/barang" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-left"></i>
                                        Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <img src="/images/{{ $barang->image }}" alt="{{ $barang->name }}" width="300px">
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $barang->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>{{ $barang->category }}</td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td>Rp. {{ number_format($barang->price, 0) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Stock</th>
                                                <td>{{ $barang->stock }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tag</th>
                                                <td>
                                                    @foreach ($barang->tags as $tag)
                                                        <span class="badge badge-info">{{ $tag->name }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Note</th>
                                                <td>{{ $barang->note }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
