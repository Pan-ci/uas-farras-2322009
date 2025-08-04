@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Edit Kustomer') }}
    @endsection

    <div class="body-box">
        <div class="container-box p-4 pt-1">
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
            <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label text-dark">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label text-dark">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                </div>

                <div class="mb-3">
                    <label for="adress" class="form-label text-dark">Adress</label>
                    <textarea type="text" class="form-control" id="adress" name="adress">{{ $customer->adress }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="email"class="form-label text-dark">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-dark">Password (Leave it blank if you don't want to change)</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-dark">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                <div class="text-center">
            </form>
        <div>
    <div>
</div>
@endsection