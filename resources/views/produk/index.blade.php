@extends('layouts.app')

@section('title', 'Nusakita')

@section('content')
<div class="index">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="daftar-produk text-center">
                <h2>Product List</h2>
                <hr>
                @if(auth()->check() && auth()->user()->role_id == 1)
                <a href="{{ route('produks.create') }}" class="btn btn-plus">Add Product</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Produk -->
    <div class="row">
        <div class="col-md-12">
            <div class="tabel">
                <div class="card-body">
                    @if ($produks->count())
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Stock</th>
                                    <th>Product Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->idproduk }}</td>
                                        <td>{{ $produk->namaproduk }}</td>
                                        <td>{{ $produk->stokproduk }}</td>
                                        <td>{{ number_format($produk->hargaproduk, 2, ',', '.') }}</td>
                                        @if(auth()->check() && auth()->user()->role_id == 1)
                                        <td>
                                            <a href="{{ route('produks.edit', $produk->idproduk) }}" class="btn btn-edit">Edit</a>
                                            <form action="{{ route('produks.destroy', $produk->idproduk) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No products found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
