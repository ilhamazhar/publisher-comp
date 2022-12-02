@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detail Naskah : {{ $script->authors }} Dkk</div>
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
                                <th>Terdaftar Pada</th>
                                <td>:</td>
                                <td>{{ $script->created_at->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Dokumen</th>
                                <td>:</td>
                                <td><a href="{{ asset('storage/docs/' . $script->doc) }}"
                                        target="_blank">{{ $script->doc }}</a></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td
                                    class="
                                        @switch($script->status_id)
                                        @case(1)
                                        text-muted
                                        @break
                                        @case(2)
                                        text-danger
                                        @break
                                        @case(3)
                                        text-warning
                                        @break
                                        @case(4)
                                        text-primary
                                        @break
                                        @default
                                        text-info
                                        @endswitch">
                                    <i>{{ $script->status->status_name }}</i>
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
