@if (count($repository->files) > 0)
    <table id="basic-table" class="table table-striped mb-0" role="grid">
        <thead>
            <tr>
                <th>Link</th>
            </tr>
        </thead>
        <tbody class='medias'>
            @foreach ($repository->links as $link)
                <tr>
                    <td>
                        <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center" style="width: 100%">
        <div class="card iq-file-manager">
            <div class="card-body card-thumbnail">
                <img src="{{ asset('images/error/02.png') }}" class="img-fluid mb-4" style="max-width: 200px">

                <h1 class="mb-2"> {{ __('links.not_found.title') }}</h1>
                <p>{{ __('links.not_found.text') }}</p>
            </div>
        </div>
    </div>
@endif
