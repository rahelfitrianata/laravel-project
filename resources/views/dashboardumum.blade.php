@extends('layouts.app')

@section('title', 'Nusakita')

@section('content')
<div class="container1">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Pagination Dots -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        </div>
                    
                        <!-- Gambar Carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('lte/assets/img/g1.png') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('lte/assets/img/g2.png') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('lte/assets/img/g3.png') }}" class="d-block w-100" alt="Product 3">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('lte/assets/img/g4.png') }}" class="d-block w-100" alt="Product 4">
                            </div>
                            <!-- Tambahkan gambar lainnya jika diperlukan -->
                        </div>
                    
                        <!-- Tombol Navigasi Kiri dan Kanan -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>   
                
                    <div class="dashboard-image">
                        <img src="{{ asset('lte/assets/img/our.png') }}" alt="Dashboard Image">
                    </div>
                      
                
    <!-- Daftar Produk Indomaret -->
    <div class="product-list">
        <div class="product-item">
            <img src="{{ asset('lte/assets/img/pr2.png') }}" alt="Produk 1" class="product-image">
            <h3 class="product-title">Nusakita Nusakita Cooking Oil</h3>
            <a href="https://www.nusakita.id/product/nusakita-cooking-oil" target="_blank" class="product-button">Preview Product</a>
        </div>
        <div class="product-item">
            <img src="{{ asset('lte/assets/img/pr1.png') }}" alt="Produk 2" class="product-image">
            <h3 class="product-title">Nusakita Pure Cane Sugar</h3>
            <a href="https://www.nusakita.id/product/nusakita-gula-tebu-murni" target="_blank" class="product-button">Preview Product</a>
        </div>
        <div class="product-item">
            <img src="{{ asset('lte/assets/img/pr3.png') }}" alt="Produk 3" class="product-image">
            <h3 class="product-title">Nusakita Java Mocha Blend</h3>
            <a href="https://www.nusakita.id/product/java-mocha-blend" target="_blank" class="product-button">Preview Product</a>
        </div>
        <div class="product-item">
            <img src="{{ asset('lte/assets/img/pr4.png') }}" alt="Produk 4" class="product-image">
            <h3 class="product-title">Nusakita Premium Black Tea</h3>
            <a href="https://www.nusakita.id/product/premium-black-tea" target="_blank" class="product-button">Preview Product</a>
        </div>
    </div>    
</div>
@endsection

