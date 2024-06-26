<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="{{ route('index') }}" class="navbar-brand">
            <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                    transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                    transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                    transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                    transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
            </svg>
            <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto  navbar-list mb-2 mb-lg-0">
                @include('partials.public.switch_language')
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0 d-flex align-items-center" href="javascript:void(0)" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"
                            style="width: 100%;height: 100%;">
                            <div class="caption ms-3 d-none d-md-block ">
                                <h6 class="mb-0 caption-title">{{ auth()->user()->full_name }}</h6>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>

                            @can('viewAny', App\Models\Repository::class)
                                <li><a class="dropdown-item"
                                        href="{{ route('repositories.index') }}">{{ __('repositories.title') }}</a></li>
                            @endcan

                            @can('viewAny', App\Models\Favority::class)
                                <li><a class="dropdown-item"
                                        href="{{ route('favorities.index') }}">{{ __('favorities.title') }}</a></li>
                            @endcan

                            @can('view', Auth::user())
                                <li><a class="dropdown-item"
                                        href="{{ route('users.show', auth()->id()) }}">{{ __('auth.profile') }}</a></li>
                            @endcan

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="javascript:void(0)" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('auth.logout') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
