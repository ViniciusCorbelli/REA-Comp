<ul class="navbar-nav iq-main-menu" id="sidebar">
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled" href="javascript:void(0)" tabindex="-1">
            <span class="mini-icon">-</span>
        </a>
    </li>

    <li>
        <hr class="hr-horizontal">
    </li>
    <li class="nav-item static-item">
        <a class="nav-link static-item disabled text-start" href="javascript:void(0)" tabindex="-1">
            <span class="default-icon">{{ __('global-message.file-manager') }}</span>
            <span class="mini-icon">-</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ activeRoute('dashboard') }}" aria-current="page" href="{{ route('dashboard') }}">
            <i class="icon">
                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.7561 22 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
                        fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">{{ __('Dashboard') }}</span>
        </a>
    </li>
    @can('viewAny', App\Models\Repository::class)
        <li class="nav-item ">
            <a class="nav-link {{ activeRoute('repositories*') }}" aria-current="page"
                href="{{ route('repositories.index') }}">
                <i class="icon">
                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.81 2H16.191C19.28 2 21 3.78 21 6.83V17.16C21 20.26 19.28 22 16.191 22H7.81C4.77 22 3 20.26 3 17.16V6.83C3 3.78 4.77 2 7.81 2ZM8.08 6.66V6.65H11.069C11.5 6.65 11.85 7 11.85 7.429C11.85 7.87 11.5 8.22 11.069 8.22H8.08C7.649 8.22 7.3 7.87 7.3 7.44C7.3 7.01 7.649 6.66 8.08 6.66ZM8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.179 15.92 11.179H8.08C7.649 11.179 7.3 11.53 7.3 11.96C7.3 12.39 7.649 12.74 8.08 12.74ZM8.08 17.31H15.92C16.319 17.27 16.62 16.929 16.62 16.53C16.62 16.12 16.319 15.78 15.92 15.74H8.08C7.78 15.71 7.49 15.85 7.33 16.11C7.17 16.36 7.17 16.69 7.33 16.95C7.49 17.2 7.78 17.35 8.08 17.31Z"
                            fill="currentColor"></path>
                    </svg>
                </i>
                <span class="item-name">{{ __('repositories.title') }}</span>
                <i class="icon" data-bs-toggle="tooltip" data-bs-placement="right">
                    <span
                        class="badge bg-warning d-inline-block rounded-pill">{{ Auth::user()->repositories()->count() }}</span></i>
            </a>
        </li>
    @endcan

    @can('viewAny', App\Models\Favority::class)
        <li class="nav-item">
            <a class="nav-link {{ activeRoute('favorities*') }}" aria-current="page" href="{{ route('favorities.index') }}">
                <i class="icon">
                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z"
                            fill="currentColor"></path>
                    </svg>
                </i>
                <span class="item-name">{{ __('favorities.title') }}</span>
                <i class="icon" data-bs-toggle="tooltip" data-bs-placement="right">
                    <span
                        class="badge bg-warning d-inline-block rounded-pill">{{ Auth::user()->favorities()->count() }}</span></i>
            </a>
        </li>
    @endcan

    @if (Auth::user()->isAdministrator())
        <li>
            <hr class="hr-horizontal">
        </li>
        <li class="nav-item static-item">
            <a class="nav-link static-item disabled text-start" href="javascript:void(0)" tabindex="-1">
                <span class="default-icon">{{ __('global-message.admin') }}</span>
                <span class="mini-icon">-</span>
            </a>
        </li>
    @endif

    @can('viewAny', App\Models\User::class)
        <li class="nav-item">
            <a class="nav-link {{ activeRoute('users*') }}" aria-current="page" href="{{ route('users.index') }}">
                <i class="icon">
                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.2124 7.76241C14.2124 10.4062 12.0489 12.5248 9.34933 12.5248C6.6507 12.5248 4.48631 10.4062 4.48631 7.76241C4.48631 5.11865 6.6507 3 9.34933 3C12.0489 3 14.2124 5.11865 14.2124 7.76241ZM2 17.9174C2 15.47 5.38553 14.8577 9.34933 14.8577C13.3347 14.8577 16.6987 15.4911 16.6987 17.9404C16.6987 20.3877 13.3131 21 9.34933 21C5.364 21 2 20.3666 2 17.9174ZM16.1734 7.84875C16.1734 9.19506 15.7605 10.4513 15.0364 11.4948C14.9611 11.6021 15.0276 11.7468 15.1587 11.7698C15.3407 11.7995 15.5276 11.8177 15.7184 11.8216C17.6167 11.8704 19.3202 10.6736 19.7908 8.87118C20.4885 6.19676 18.4415 3.79543 15.8339 3.79543C15.5511 3.79543 15.2801 3.82418 15.0159 3.87688C14.9797 3.88454 14.9405 3.90179 14.921 3.93246C14.8955 3.97174 14.9141 4.02253 14.9396 4.05607C15.7233 5.13216 16.1734 6.44206 16.1734 7.84875ZM19.3173 13.7023C20.5932 13.9466 21.4317 14.444 21.7791 15.1694C22.0736 15.7635 22.0736 16.4534 21.7791 17.0475C21.2478 18.1705 19.5335 18.5318 18.8672 18.6247C18.7292 18.6439 18.6186 18.5289 18.6333 18.3928C18.9738 15.2805 16.2664 13.8048 15.5658 13.4656C15.5364 13.4493 15.5296 13.4263 15.5325 13.411C15.5345 13.4014 15.5472 13.3861 15.5697 13.3832C17.0854 13.3545 18.7155 13.5586 19.3173 13.7023Z"
                            fill="currentColor"></path>
                    </svg>
                </i>
                <span class="item-name">{{ __('users.title') }}</span>
            </a>
        </li>
    @endcan

    @can('viewAll', App\Models\Repository::class)
    <li class="nav-item ">
        <a class="nav-link {{ activeRoute('admin.repositories.index') }}" aria-current="page" href="{{ route('admin.repositories.index') }}">
            <i class="icon">
                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.81 2H16.191C19.28 2 21 3.78 21 6.83V17.16C21 20.26 19.28 22 16.191 22H7.81C4.77 22 3 20.26 3 17.16V6.83C3 3.78 4.77 2 7.81 2ZM8.08 6.66V6.65H11.069C11.5 6.65 11.85 7 11.85 7.429C11.85 7.87 11.5 8.22 11.069 8.22H8.08C7.649 8.22 7.3 7.87 7.3 7.44C7.3 7.01 7.649 6.66 8.08 6.66ZM8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.179 15.92 11.179H8.08C7.649 11.179 7.3 11.53 7.3 11.96C7.3 12.39 7.649 12.74 8.08 12.74ZM8.08 17.31H15.92C16.319 17.27 16.62 16.929 16.62 16.53C16.62 16.12 16.319 15.78 15.92 15.74H8.08C7.78 15.71 7.49 15.85 7.33 16.11C7.17 16.36 7.17 16.69 7.33 16.95C7.49 17.2 7.78 17.35 8.08 17.31Z"
                        fill="currentColor"></path>
                </svg>
            </i>
            <span class="item-name">{{ __('repositories.title') }}</span>
        </a>
    </li>
    @endcan

    @can('viewAny', App\Models\Topic::class)
        <li class="nav-item">
            <a class="nav-link {{ activeRoute('topics*') }}" aria-current="page" href="{{ route('topics.index') }}">
                <i class="icon">
                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12ZM17.7366 6.04606C19.4439 7.36485 20.8976 9.29455 21.9415 11.7091C22.0195 11.8933 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8933 2.05854 11.7091C4.14634 6.88 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM12.0012 14.4124C13.3378 14.4124 14.4304 13.3264 14.4304 11.9979C14.4304 10.6597 13.3378 9.57362 12.0012 9.57362C11.8841 9.57362 11.767 9.58332 11.6597 9.60272C11.6207 10.6694 10.7426 11.5227 9.65971 11.5227H9.61093C9.58166 11.6779 9.56215 11.833 9.56215 11.9979C9.56215 13.3264 10.6548 14.4124 12.0012 14.4124Z"
                            fill="currentColor"></path>
                    </svg>
                </i>
                <span class="item-name">{{ __('topics.title') }}</span>
            </a>
        </li>
    @endcan

    @can('viewAny', App\Models\Type::class)
        <li class="nav-item">
            <a class="nav-link {{ activeRoute('types*') }}" aria-current="page" href="{{ route('types.index') }}">
                <i class="icon">
                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M21.7872 10.539C21.6518 10.6706 21.4681 10.7457 21.2747 10.7457C20.559 10.7457 19.9787 11.3095 19.9787 11.9953C19.9787 12.6858 20.5522 13.2467 21.2611 13.2543C21.6605 13.258 22 13.5286 22 13.9166V16.3265C22 18.3549 20.3075 20 18.2186 20H15.0658C14.7398 20 14.4758 19.7435 14.4758 19.4269V17.3975C14.4758 17.0029 14.1567 16.6929 13.7505 16.6929C13.354 16.6929 13.0251 17.0029 13.0251 17.3975V19.4269C13.0251 19.7435 12.7611 20 12.4362 20H5.78143C3.70213 20 2 18.3558 2 16.3265V13.9166C2 13.5286 2.33946 13.258 2.73888 13.2543C3.44874 13.2467 4.02128 12.6858 4.02128 11.9953C4.02128 11.3282 3.46035 10.8209 2.72534 10.8209C2.53191 10.8209 2.34816 10.7457 2.21277 10.6142C2.07737 10.4827 2 10.3042 2 10.1163V7.68291C2 5.65731 3.706 4 5.7911 4H12.4362C12.7611 4 13.0251 4.25649 13.0251 4.57311V6.97827C13.0251 7.36348 13.354 7.68291 13.7505 7.68291C14.1567 7.68291 14.4758 7.36348 14.4758 6.97827V4.57311C14.4758 4.25649 14.7398 4 15.0658 4H18.2186C20.3075 4 22 5.64416 22 7.67352V10.0411C22 10.229 21.9226 10.4075 21.7872 10.539ZM13.7505 14.8702C14.1567 14.8702 14.4758 14.5508 14.4758 14.1656V10.4075C14.4758 10.0223 14.1567 9.70288 13.7505 9.70288C13.354 9.70288 13.0251 10.0223 13.0251 10.4075V14.1656C13.0251 14.5508 13.354 14.8702 13.7505 14.8702Z"
                            fill="currentColor"></path>
                    </svg>
                </i>
                <span class="item-name">{{ __('types.title') }}</span>
            </a>
        </li>
    @endcan
</ul>
