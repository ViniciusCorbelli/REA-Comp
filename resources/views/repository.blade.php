<x-app-layout layout="simple" :assets="$assets ?? []">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="border-bottom">
                            <div class="d-flex flex-column align-content-between justify-items-center mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h2 class="mb-0">{{ $repository->title }}</h2>
                                    @include('partials.dashboard.favorities')
                                </div>
                            </div>

                        </div>
                        <div class="border-bottom">
                            <p class="py-4 mb-0">{{ $repository->description }}</p>
                        </div>
                    </div>
                </div>

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
                                            <h6><a
                                                    href="{{ asset('storage/' . $media->path) }}">{{ $media->file_name }}</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <td>{{ formatSizeUnits($media->size) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if ($repository != null && count($repository->links) > 0)
                    <div class="border-bottom pb-3 d-flex align-items-center justify-content-between">
                        <h4>Links</h4>
                    </div>

                    @foreach ($repository->links as $link)
                        <div class="form-group input-group form-group-alt">
                            <h6>
                                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                            </h6>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
