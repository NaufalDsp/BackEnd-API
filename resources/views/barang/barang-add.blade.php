@extends('template.main')
@section('title', 'Add Barang')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/barang">Barang</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-right">
                                    <a href="/barang" class="btn btn-warning btn-sm"><i
                                            class="fa-solid fa-arrow-rotate-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <form class="needs-validation" novalidate action="/barang" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    placeholder="Name Barang" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="id_kategori">Category</label>
                                                <select name="id_kategori"
                                                    class="form-control @error('id_kategori') is-invalid @enderror"
                                                    id="id_kategori" required>
                                                    @foreach ($kategoris as $kategori)
                                                        <option value="{{ $kategori->id_kategori }}"
                                                            {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                                            {{ $kategori->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_kategori')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                                    placeholder="Price" value="{{ old('price') }}" required>
                                                @error('price')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" min="1" name="stock"
                                                    class="form-control @error('stock') is-invalid @enderror" id="stock"
                                                    placeholder="Stock" value="{{ old('stock') }}" required>
                                                @error('stock')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class=" form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="image"
                                                    class="form-control @error('image') is-invalid @enderror" id="image"
                                                    required>
                                                @error('image')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="tags">Tags</label>
                                                <div>
                                                    @foreach ($tags as $tag)
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="tags[]"
                                                                value="{{ $tag->id_tag }}"
                                                                @if (in_array($tag->id_tag, old('tags', []))) checked @endif>
                                                            <label class="form-check-label">{{ $tag->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @error('tags')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" cols="10"
                                                    rows="5" placeholder="note">{{ old('note') }}</textarea>
                                                @error('note')
                                                    <span class="invalid-feedback text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-dark mr-1" type="reset"><i
                                            class="fa-solid fa-arrows-rotate"></i>
                                        Reset</button>
                                    <button class="btn btn-success" type="submit"><i
                                            class="fa-solid fa-floppy-disk"></i>
                                        Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.content -->
                </div>
            </div>
        </div>
    </div>

@endsection