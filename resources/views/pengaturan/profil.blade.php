@extends('layouts.prof')

@section('content')
<div class="profil">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <hr>
                    <!-- Tombol untuk Mengedit Profil -->
                    <a href="{{ route('pengaturan.editProfil') }}" class="btn btn-edit">Edit Profile</a>
                    <a href="{{ route('dashboard.umum') }}" class="btn btn-danger">Cancel</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
