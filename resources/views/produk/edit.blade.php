@extends('layouts.app')

@section('title', 'Nusakita')
@section('content')
<div class="index1">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card for Creating New Product -->
            <div class="index1">
                <div class="card-header text-center">
                    <h4>Edit Produk</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('produks.update', $produk->idproduk) }}" method="POST">
                @csrf
            @method('PUT')
            <!-- Form fields here -->
            <div class="form-group mb-3">
                <label for="idproduk">ID Produk</label>
                <input type="number" name="idproduk" id="idproduk" class="form-control" value="{{ $produk->idproduk }}" required>
            </div>
            <div class="mb-3">
                <label for="namaproduk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="namaproduk" name="namaproduk" value="{{ $produk->namaproduk }}" required>
            </div>
            <div class="mb-3">
                <label for="stokproduk" class="form-label">Stok Produk</label>
                <input type="number" class="form-control" id="stokproduk" name="stokproduk" value="{{ $produk->stokproduk }}" required>
            </div>
            <div class="mb-3">
                <label for="hargaproduk" class="form-label">Harga Produk</label>
                <input type="number" step="0.01" class="form-control" id="hargaproduk" name="hargaproduk" value="{{ $produk->hargaproduk }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-edit">Perbarui Produk</button>
                <a href="{{ route('produks.index') }}" class="btn btn-hapus">Kembali</a>
            </div>
        </form>
    </div>
@endsection
