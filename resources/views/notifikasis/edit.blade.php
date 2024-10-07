@extends('layouts.app')

@section('title', 'Edit Notifikasi')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Edit Pengaduan</h1>

            <form method="POST" action="{{ route('notifikasi.update', $notifikasi->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $notifikasi->title }}" required>
                </div>
                <div class="form-group">
                    <label for="message">Pesan</label>
                    <textarea name="message" id="message" class="form-control" rows="3" required>{{ $notifikasi->message }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('notifikasis.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
