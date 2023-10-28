<x-app-layout layout="simple" :assets="$assets ?? []">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="border-bottom">
                        <div class="d-flex flex-column align-content-between justify-items-center mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h2 class="mb-0">{{ $repository->title }}</h2>
                                <div class="d-flex justify-content-end ">
                                    @include('partials.repository.favorities')
                                </div>
                            </div>
                            <div class=" d-flex align-items-center w-100">
                                @include('partials.repository.rate')
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom">
                        <div class="text show-first-lines">
                            <p class="py-4 mb-0">{!! nl2br($repository->description) !!}</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column py-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-dark">{{ __('repositories.topic') }}:</span>
                            <span class="text-primary  ms-2">{{ $repository->topic->name }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-dark">{{ __('global-message.created_on') }}:</span>
                            <span
                                class="text-primary  ms-2">{{ date('d F, Y', strtotime($repository->created_at)) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <nav class="tab-bottom-bordered">
                    <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                        <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-description" type="button" role="tab"
                            aria-controls="nav-description"
                            aria-selected="true">{{ __('repositories.description') }}</button>
                        <button class="nav-link" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info"
                            type="button" role="tab" aria-controls="nav-info" aria-selected="false"
                            tabindex="-1">{{ __('repositories.file') }}</button>
                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review"
                            type="button" role="tab" aria-controls="nav-review" aria-selected="false"
                            tabindex="-1">{{ __('repositories.comments') }}
                            ({{ count($repository->comments()->get()) }})</button>
                    </div>
                </nav>
                <div class="tab-content mt-4" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-description" role="tabpanel"
                        aria-labelledby="nav-description-tab">
                        <div class="d-flex flex-column">
                            <p class="mb-0">{!! nl2br($repository->description) !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                        <div class="row">
                            <div class="col-lg-6">
                                @include('partials.repository.files')
                            </div>
                            <div class="col-lg-6">
                                @include('partials.repository.links')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                        @include('partials.repository.comments')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
