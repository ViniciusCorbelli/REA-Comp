<x-app-layout :assets="$assets ?? []">
    <div class="conatiner-fluid content-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                    <h4 class="me-2 h4">{{ $data->first_name }}</h4>
                                    <span class="text-capitalize"> {{ $data->last_name }}</span>
                                </div>
                            </div>
                            <ul class="d-flex nav nav-pills mb-0 text-center profile-tab nav-slider">
                                <li class="nav-item">
                                    <a class="nav-link show active">Perfil</a>
                                </li>
                                @can('update', $data)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.edit', $id) }}">Editar</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">{{ __('users.about_user') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mt-2">
                            <h6 class="mb-1">{{ __('users.first_name') }}:</h6>
                            <p>{{ $data->first_name }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">{{ __('users.last_name') }}:</h6>
                            <p>{{ $data->last_name }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">{{ __('users.joined') }}:</h6>
                            <p>{{ date('M d, Y', strtotime($data->created_at)) }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">{{ __('users.email') }}:</h6>
                            <p><a href="#" class="text-body"> {{ $data->email }}</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                @if (Auth::user()->repositories->count() > 0)
                    @foreach (Auth::user()->repositories()->paginate(12) as $key => $repository)
                        <div class="card">
                            @if ($key == 0)
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">{{ __('repositories.title') }}</h4>
                                    </div>
                                </div>
                            @endif
                            <a href={{ route('repository', $repository->id) }}>
                                <div class="card-header d-flex align-items-center justify-content-between pb-4">
                                    <div class="header-title">
                                        <div class="d-flex flex-wrap">
                                            <div class="media-support-info mt-2">
                                                <h5 class="mb-0">{{ $repository->title }}</h5>
                                                <p class="mb-0 text-primary">
                                                    {{ $repository->user->first_name . ' ' . $repository->user->last_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton07"
                                            data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                            {{ date('M d, Y', strtotime($repository->created_at)) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="card-body p-0">
                                <p class="p-3 mb-0 first-lines">{!! nl2br($repository->description) !!}</p>
                                <div class="comment-area p-3">
                                    <hr class="mt-0">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center message-icon me-3">
                                                <svg width="20" height="20" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z">
                                                    </path>
                                                </svg>
                                                <span class="ms-1">{{ $repository->favorities()->count() }}</span>
                                            </div>
                                            <div class="d-flex align-items-center feather-icon">
                                                <svg width="20" height="20" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10Z">
                                                    </path>
                                                </svg>
                                                <span class="ms-1">{{ $repository->comments()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="text-center" style="width: 100%">
                            <div class="card iq-file-manager">
                                <div class="card-body card-thumbnail">
                                    <img src="{{ asset('images/error/02.png') }}" class="img-fluid mb-4"
                                        style="max-width: 200px">

                                    <h1 class="mb-2"> {{ __('repositories.not_found.title') }}</h1>
                                    <p>{{ __('repositories.not_found.text') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>

            @if (Auth::user()->repositories()->paginate(12)->hasPages())
                <div class="card">
                    {{ Auth::user()->repositories->links('pagination::bootstrap-4') }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
