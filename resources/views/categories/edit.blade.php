@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Edit Kategori') }}
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
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label text-dark">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection