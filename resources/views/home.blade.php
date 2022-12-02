@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (auth()->user()->role_id == 1)
                            <h2>Logs User AGS App</h2>

                            <table class="table table-bordered my-3">
                                <thead>
                                    <th>Nama</th>
                                    <th>Kegiatan</th>
                                    <th>Waktu</th>
                                </thead>
                                <tbody>
                                    @foreach ($activity_log as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td><span
                                                    class="badge rounded-pill text-bg-primary">{{ $item->description }}</span>
                                            </td>
                                            <td>{{ $item->user->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2>Welcome To AGS App</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
