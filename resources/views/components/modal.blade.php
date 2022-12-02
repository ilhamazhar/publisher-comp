<!-- Modal -->
<div class="modal fade" id="{{ $script }}" tabindex="-1" aria-labelledby="editStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editStatusLabel">Edit Status Naskah</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('scripts.update', $script) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
