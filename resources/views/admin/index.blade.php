@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Semua Naskah</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Nama Penulis</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($scripts as $script)
                                    <tr>
                                        <td><i>{{ $script->authors }}</i></td>
                                        <td><i>{{ $script->email }}</i></td>
                                        <td><i>{{ $script->phone }}</i></td>
                                        <td
                                            class="{{ $script->status == 1 ? 'text-warning' : ($script->status == 2 ? 'text-info' : 'text-primary') }}">
                                            <i>{{ $script->status == 1 ? 'Diproses' : ($script->status == 2 ? 'Silahkan Revisi' : 'Diterima') }}</i>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('scripts.show', $script) }}"
                                                class="btn btn-primary btn-sm me-2" title="Detail">
                                                <i class="fa-solid fa-bars"></i>
                                            </a>
                                            <a href="{{ route('scripts.edit', $script) }}" class="btn btn-success btn-sm"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @empty($script)
                            <div class="row text-muted text-center">
                                <h5 class="">Data tidak ditemukan !</h5>
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
