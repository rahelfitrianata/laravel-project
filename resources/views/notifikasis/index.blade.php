@extends('layouts.app')

@section('title', 'Customer Complaints')

@section('content')
<div class="notifikasi">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-center">Customer Complaints</h2>
            <hr>

            <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form untuk menambahkan pengaduan -->
            <form method="POST" action="{{ route('notifikasis.kirim') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="3" required></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-edit" style="width: 50%; margin-left: 300px;">Send</button>
            </form>
            <hr>

            <!-- Tabel daftar pengaduan -->
            <div class="bl">
                <div class="card-header">
                    <h5 class="card-title">Complaint List</h5>
                </div>
                <div class="card-body">
                    @if ($notifikasis->count())
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifikasis as $notifikasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $notifikasi->title }}</td>
                                        <td>{{ $notifikasi->message }}</td>
                                        <td>{{ $notifikasi->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('notifikasi.edit', $notifikasi->id) }}" class="btn btn-edit btn-sm">Edit</a>
                                            <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">No Complaints.</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="text-center">
                <a href="{{ route('dashboard.umum') }}" class="btn btn-primary">Back</a>
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection
