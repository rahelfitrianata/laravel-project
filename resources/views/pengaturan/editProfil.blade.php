@extends('layouts.app')

@section('content')
<div class="profil">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form action="{{ route('pengaturan.updateProfil') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Name:</label>
                            <input type="text" name="nama" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-edit">Save Changes</button>
                            <a href="{{ route('pengaturan.profil') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
