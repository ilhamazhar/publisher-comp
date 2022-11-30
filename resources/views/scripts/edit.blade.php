@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Naskah : </div>
                    <div class="card-body">
                        <form action="{{ route('scripts.update', $script) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="authors" class="form-label">Nama - Nama Penulis</label>
                                <textarea class="form-control @error('authors') is-invalid @enderror" id="authors" name="authors" rows="3">{{ old('authors', $script->authors) }}</textarea>
                                @error('authors')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email', $script->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No HP</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" id="phone" value="{{ old('phone', $script->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="head" class="form-label">Judul Naskah</label>
                                <input type="text" class="form-control @error('head') is-invalid @enderror"
                                    name="head" id="head" value="{{ old('head', $script->head) }}">
                                @error('head')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status_id" class="form-label">Status</label>
                                <select class="form-select @error('status_id') is-invalid @enderror" name="status_id">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ old('status_id', $status->id) == $script->status_id ? 'selected' : '' }}>
                                            {{ $status->status_name }}</option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('scripts.index') }}" class="btn btn-dark">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
