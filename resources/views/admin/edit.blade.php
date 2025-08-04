@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Edit User') }}
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

            <!-- Form untuk mengedit produk -->
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label text-dark">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>             

                <div class="mb-3">
                    <label for="phone" class="form-label text-dark">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>
                
                <div class="mb-3">
                    <label for="adress" class="form-label text-dark">Adress</label>
                    <textarea type="text" class="form-control" id="adress" name="adress">{{ $user->adress }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="role" class="text-dark mb-2">Role</label>
                    <select name="role" id="role" class="form-control">
                            <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-dark">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="text-dark mb-2">Password (Leave it blank if you don't want to change)</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="text-dark mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection