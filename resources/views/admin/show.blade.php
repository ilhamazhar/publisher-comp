@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detail Naskah : {{ $script->user->name }} Dkk</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nama Penulis</th>
                                <td>:</td>
                                <td>{{ $script->authors }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $script->email }}</td>
                            </tr>
                            <tr>
                                <th>No Hp</th>
                                <td>:</td>
                                <td>{{ $script->phone }}</td>
                            </tr>
                            <tr>
                                <th>Judul</th>
                                <td>:</td>
                                <td>{{ $script->head }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td
                                    class="{{ $script->status == 1 ? 'text-warning' : ($script->status == 2 ? 'text-info' : 'text-primary') }}">
                                    <i>{{ $script->status == 1 ? 'Diproses' : ($script->status == 2 ? 'Silahkan Revisi' : 'Diterima') }}</i>
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('scripts.index') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
