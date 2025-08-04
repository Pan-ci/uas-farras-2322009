@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Tambah Pengguna Baru') }}
    @endsection

    <div class="body-box">
        <div class="container-box p-4 pt-3">
            <!-- Menampilkan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form untuk menambahkan pengguna baru -->
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label text-dark">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label text-dark">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label for="adress" class="form-label text-dark">Alamat</label>
                    <textarea class="form-control" id="adress" name="adress" value="{{ old('adress') }}"></textarea>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label text-dark">Role</label>
                    <select name="role" id="role" class="form-control">
                            <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role', null) == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-dark">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-dark">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-dark">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
