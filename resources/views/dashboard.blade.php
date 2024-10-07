@extends('layouts.app')

@section('title', 'Nusakita')

@section('content')
<div class="container1">
    <div class="row">
            <!-- Statistik Produk -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-hijau">
                        <h5 class="card-title">Total Product</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Number of Products.</p>
                        <!-- Misalnya, menampilkan jumlah produk -->
                        <h2>{{ $totalProduk }}</h2>
                    </div>
                </div>
            </div>

            <!-- Statistik Penjualan -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-hijau">
                        <h5 class="card-title">Total Product Sales</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Number of Product Sales.</p>
                        <!-- Misalnya, menampilkan total penjualan -->
                        <h2>{{ number_format($totalPenjualan, 2, ',', '.') }}</h2>
                    </div>
                </div>
            </div>

            <!-- Statistik Pengguna -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-hijau">
                        <h5 class="card-title">Total Product Stock  </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Product Stock Amount.</p>
                        <!-- Misalnya, menampilkan jumlah stok -->
                        <h2>{{ $totalStok }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="grafik">
            <div class="card-body">
                <h3 class="text-center">Sales Chart</h3>
            </div>
            <!-- Chart.js Script -->
            <canvas id="productChart" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Variabel untuk warna chart
                var brownColor = 'rgba(139, 69, 19, 0.7)'; // Coklat dengan transparansi
                var greenColor = 'rgba(34, 139, 34, 0.7)'; // Hijau dengan transparansi

                var ctx = document.getElementById('productChart').getContext('2d');
                var productChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($products->pluck('namaproduk')),
                        datasets: [
                            {
                                label: 'Product Stock',
                                data: @json($products->pluck('stokproduk')),
                                backgroundColor: brownColor,  // Mengatur warna coklat
                                borderWidth: 1
                            },
                            {
                                label: 'Product Price',
                                data: @json($products->pluck('hargaproduk')),
                                backgroundColor: greenColor,  // Mengatur warna hijau
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: true, // Membuat grafik responsif
                    }
                });
            </script>
        </div>
    </div>
</div>

@endsection
