@if (count($repository->files) > 0)
    <table id="basic-table" class="table table-striped mb-0" role="grid">
        <thead>
            <tr>
                <th>{{ __('global-message.name') }}</th>
                <th>{{ __('global-message.size') }}</th>
            </tr>
        </thead>
        <tbody class='medias'>
            @foreach ($repository->files as $media)
                <tr id="media-{{ $media->id }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                src="{{ getImage($media->mime_type) }}">
                            <h6><a onclick="count({{ $repository->id }}, {{ $media->id }})" target="_blank"
                                    href="{{ asset('storage/' . $media->path) }}">{{ $media->file_name }}</a>
                            </h6>
                        </div>
                    </td>
                    <td>{{ formatSizeUnits($media->size) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function count(repository_id, file_id) {
            const token = '{{ csrf_token() }}';
            fetch('{{ route('download') }}?' + new URLSearchParams({
                    repository_id: repository_id,
                    file_id: file_id
                }), {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': token
                    }
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    location.reload()
                })
                .catch(error => console.error(error));
        }
    </script>
@else
    <div class="text-center" style="width: 100%">
        <div class="card iq-file-manager">
            <div class="card-body card-thumbnail">
                <img src="{{ asset('images/error/02.png') }}" class="img-fluid mb-4" style="max-width: 200px">

                <h1 class="mb-2"> {{ __('files.not_found.title') }}</h1>
                <p>{{ __('files.not_found.text') }}</p>
            </div>
        </div>
    </div>
@endif
