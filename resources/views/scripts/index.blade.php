@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Data Semua Naskah :</div>

                    <div class="card-body">
                        @cannot('viewAny', \App\Models\Script::class)
                            <a href="{{ route('scripts.create') }}" class="btn btn-primary mb-3">
                                <i class="fa-regular fa-square-plus me-1"></i> Tambah Naskah
                            </a>
                        @elsecannot('viewAny')
                            <a href="{{ route('scripts.birtday') }}" class="btn btn-danger mb-3">
                                <i class="fa-solid fa-cake-candles me-1"></i> Naskah Ulang tahun
                            </a>
                        @endcannot
                        <table class="table">
                            <thead>
                                @can('viewAny', \App\Models\Script::class)
                                    <th>No</th>
                                @endcan
                                <th>Nama Penulis</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Terdaftar Pada</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($scripts as $script)
                                    @can('view', $script)
                                        <tr>
                                            @can('viewAny', \App\Models\Script::class)
                                                <td><b>{{ $scripts->firstItem() + $loop->index }}</b></td>
                                            @endcan
                                            <td><i>{{ $script->authors }}</i></td>
                                            <td><i>{{ $script->email }}</i></td>
                                            <td><i>{{ $script->phone }}</i></td>
                                            <td><i>{{ $script->created_at->format('d-m-Y') }}</i></td>
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
                                            <td class="d-flex">
                                                <a href="{{ route('scripts.show', $script) }}" class="btn btn-primary btn-sm"
                                                    title="Detail">
                                                    <i class="fa-solid fa-bars"></i>
                                                </a>
                                                <a href="{{ route('scripts.edit', $script) }}"
                                                    class="btn btn-success btn-sm mx-2" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                @can('delete', $script)
                                                    <form action="{{ route('scripts.destroy', $script) }}" method="post"
                                                        onsubmit="return confirm('Yakin dihapus ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endcan
                                    {{-- <x-modal> --}}
                                @endforeach
                            </tbody>
                        </table>
                        @can('viewAny', \App\Models\Script::class)
                            {{ $scripts->links('pagination::bootstrap-4') }}
                        @endcan

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

@section('js')
    <script>
        $(document).on('click', '.open_modal', function() {
            var url = "domain.com/yoururl";
            var tour_id = $(this).val();
            $.get(url + '/' + tour_id, function(data) {
                //success data
                console.log(data);
                $('#tour_id').val(data.id);
                $('#name').val(data.name);
                $('#details').val(data.details);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            })
        });
    </script>
@endsection
