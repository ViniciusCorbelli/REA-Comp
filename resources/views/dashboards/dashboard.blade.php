<x-app-layout :assets="$assets ?? []">
    <div class="content-inner pb-0 container-fluid" id="page_layout">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">{{ __('dashboard.title') }}</h3>
                <div class="row row-cols-lg-4 row-cols-md-4 row-cols-1 ">
                    <div class="col">
                        <div class="card card-folder">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a
                                        class="avatar-40 bg-soft-primary rounded-pill d-flex justify-content-center align-items-center">
                                        <svg width="24" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M16.3328 22H7.66618C4.2769 22 2 19.6229 2 16.0843V7.91672C2 4.37811 4.2769 2 7.66618 2H16.3338C19.7231 2 22 4.37811 22 7.91672V16.0843C22 19.6229 19.7231 22 16.3328 22Z"
                                                fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.2451 8.67496C11.2451 10.045 10.1301 11.16 8.7601 11.16C7.3891 11.16 6.2751 10.045 6.2751 8.67496C6.2751 7.30496 7.3891 6.18896 8.7601 6.18896C10.1301 6.18896 11.2451 7.30496 11.2451 8.67496ZM19.4005 14.0876C19.6335 14.3136 19.8005 14.5716 19.9105 14.8466C20.2435 15.6786 20.0705 16.6786 19.7145 17.5026C19.2925 18.4836 18.4845 19.2246 17.4665 19.5486C17.0145 19.6936 16.5405 19.7556 16.0675 19.7556H7.6865C6.8525 19.7556 6.1145 19.5616 5.5095 19.1976C5.1305 18.9696 5.0635 18.4446 5.3445 18.1026C5.8145 17.5326 6.2785 16.9606 6.7465 16.3836C7.6385 15.2796 8.2395 14.9596 8.9075 15.2406C9.1785 15.3566 9.4505 15.5316 9.7305 15.7156C10.4765 16.2096 11.5135 16.8876 12.8795 16.1516C13.8132 15.641 14.3552 14.7673 14.827 14.0069L14.8365 13.9916C14.8682 13.9407 14.8997 13.8898 14.9311 13.8391C15.0915 13.5799 15.2495 13.3246 15.4285 13.0896C15.6505 12.7986 16.4745 11.8886 17.5395 12.5366C18.2185 12.9446 18.7895 13.4966 19.4005 14.0876Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <h5>{{ __('global-message.image') }}</h5>
                                    <p class="mb-0">{{ $storage['imagens']['count'] }}
                                        {{ __('global-message.items') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-folder">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a
                                        class="avatar-40 bg-soft-primary rounded-pill d-flex justify-content-center align-items-center">
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <h5>{{ __('global-message.video') }}</h5>
                                    <p class="mb-0">{{ $storage['videos']['count'] }} {{ __('global-message.items') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-folder">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a
                                        class="avatar-40 bg-soft-primary rounded-pill d-flex justify-content-center align-items-center">
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5036 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0463C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.299 9.012 20.0475 9.013C19.6247 9.016 19.1177 9.021 18.8088 9.021Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M16.0842 2.56737C15.7852 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2802 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z"
                                                fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.97398 11.3877H12.359C12.77 11.3877 13.104 11.0547 13.104 10.6437C13.104 10.2327 12.77 9.89868 12.359 9.89868H8.97398C8.56298 9.89868 8.22998 10.2327 8.22998 10.6437C8.22998 11.0547 8.56298 11.3877 8.97398 11.3877ZM8.97408 16.3819H14.4181C14.8291 16.3819 15.1631 16.0489 15.1631 15.6379C15.1631 15.2269 14.8291 14.8929 14.4181 14.8929H8.97408C8.56308 14.8929 8.23008 15.2269 8.23008 15.6379C8.23008 16.0489 8.56308 16.3819 8.97408 16.3819Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <h5>{{ __('global-message.documents') }}</h5>
                                    <p class="mb-0">{{ $storage['documents']['count'] }}
                                        {{ __('global-message.items') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-folder">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a
                                        class="avatar-40 bg-soft-primary rounded-pill d-flex justify-content-center align-items-center">
                                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.3571 6.45056C13.3068 5.96422 13.2543 5.45963 13.1254 4.95611C12.7741 3.75153 11.801 3.00001 10.7576 3.00001C10.1757 2.99786 9.43954 3.35644 9.0222 3.71932L5.56287 6.61697H3.75194C2.41918 6.61697 1.34751 7.6444 1.14513 9.12705C0.973161 10.5506 0.931217 13.2379 1.14513 14.8042C1.33073 16.3706 2.35416 17.383 3.75194 17.383H5.56287L9.08931 20.3236C9.45107 20.6382 10.0897 20.9989 10.6769 20.9989C10.7146 21 10.7482 21 10.7817 21C11.845 21 12.7814 20.2206 13.1327 19.0192C13.2659 18.5082 13.312 18.0293 13.3571 17.5666L13.4043 17.1082C13.5846 15.6213 13.5846 8.36908 13.4043 6.89288L13.3571 6.45056Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M17.4064 6.49468C17.118 6.06953 16.5465 5.96325 16.1281 6.25849C15.7139 6.55587 15.6112 7.14206 15.8995 7.56613C16.7017 8.74816 17.1432 10.3221 17.1432 12.0001C17.1432 13.6771 16.7017 15.252 15.8995 16.4341C15.6112 16.8581 15.7139 17.4443 16.1292 17.7417C16.2844 17.8512 16.4658 17.9092 16.6524 17.9092C16.9534 17.9092 17.2344 17.7578 17.4064 17.5055C18.4193 16.0132 18.9782 14.0582 18.9782 12.0001C18.9782 9.94201 18.4193 7.98698 17.4064 6.49468Z"
                                                fill="currentColor"></path>
                                            <path opacity="0.4"
                                                d="M20.5672 3.45726C20.2809 3.03319 19.7073 2.92475 19.29 3.22107C18.8758 3.51845 18.773 4.10464 19.0603 4.52871C20.4172 6.52776 21.1649 9.18169 21.1649 11.9999C21.1649 14.8192 20.4172 17.4731 19.0603 19.4722C18.773 19.8973 18.8758 20.4824 19.291 20.7798C19.4462 20.8893 19.6266 20.9473 19.8132 20.9473C20.1142 20.9473 20.3963 20.7959 20.5672 20.5436C22.1359 18.2343 22.9999 15.2003 22.9999 11.9999C22.9999 8.80164 22.1359 5.76657 20.5672 3.45726Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-4">
                                    <h5>{{ __('global-message.other') }}</h5>
                                    <p class="mb-0">{{ $storage['others']['count'] }}
                                        {{ __('global-message.items') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('dashboard.storage_details') }}</h4>
                    </div>

                    <div class="card-body">

                        <div class="text-center">
                            <canvas id="chart"></canvas>
                            <h2>
                                {{ formatSizeUnits($storage['used']) }}
                            </h2>
                            {{ __('global-message.used of') }} {{ formatSizeUnits($storage['total']) }}
                        </div>

                        <hr>

                        <div class="d-flex flex flex-column gap-4">
                            <div class="d-flex gap-3">
                                <span class="avatar-50 bg-soft-primary rounded">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z"
                                            fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07996 6.6499V6.6599C7.64896 6.6599 7.29996 7.0099 7.29996 7.4399C7.29996 7.8699 7.64896 8.2199 8.07996 8.2199H11.069C11.5 8.2199 11.85 7.8699 11.85 7.4289C11.85 6.9999 11.5 6.6499 11.069 6.6499H8.07996ZM15.92 12.7399H8.07996C7.64896 12.7399 7.29996 12.3899 7.29996 11.9599C7.29996 11.5299 7.64896 11.1789 8.07996 11.1789H15.92C16.35 11.1789 16.7 11.5299 16.7 11.9599C16.7 12.3899 16.35 12.7399 15.92 12.7399ZM15.92 17.3099H8.07996C7.77996 17.3499 7.48996 17.1999 7.32996 16.9499C7.16996 16.6899 7.16996 16.3599 7.32996 16.1099C7.48996 15.8499 7.77996 15.7099 8.07996 15.7399H15.92C16.319 15.7799 16.62 16.1199 16.62 16.5299C16.62 16.9289 16.319 17.2699 15.92 17.3099Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="w-100 ">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ __('global-message.documents') }}</h6>
                                        <p>{{ formatSizeUnits($storage['documents']['size']) }}</p>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 8px">
                                        <div class="progress-bar bg-primary" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="{{ $storage['total'] > 0 ? ($storage['documents']['size'] / $storage['total']) * 100 : 0 }}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{ $storage['total'] > 0 ? ($storage['documents']['size'] / $storage['total']) * 100 : 0 }}%; transition: width 2s ease 0s;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3 ">
                                <span class="avatar-50 bg-soft-primary rounded">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="w-100 ">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ __('global-message.video') }}</h6>
                                        <p>{{ formatSizeUnits($storage['videos']['size']) }}</p>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 8px">
                                        <div class="progress-bar bg-success" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="{{ $storage['total'] > 0 ? ($storage['videos']['size'] / $storage['total']) * 100 : 0 }}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{ $storage['total'] > 0 ? ($storage['videos']['size'] / $storage['total']) * 100 : 0 }}%; transition: width 2s ease 0s;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <span class="avatar-50 bg-soft-primary rounded">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M16.3328 22H7.66618C4.2769 22 2 19.6229 2 16.0843V7.91672C2 4.37811 4.2769 2 7.66618 2H16.3338C19.7231 2 22 4.37811 22 7.91672V16.0843C22 19.6229 19.7231 22 16.3328 22Z"
                                            fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.2451 8.67496C11.2451 10.045 10.1301 11.16 8.7601 11.16C7.3891 11.16 6.2751 10.045 6.2751 8.67496C6.2751 7.30496 7.3891 6.18896 8.7601 6.18896C10.1301 6.18896 11.2451 7.30496 11.2451 8.67496ZM19.4005 14.0876C19.6335 14.3136 19.8005 14.5716 19.9105 14.8466C20.2435 15.6786 20.0705 16.6786 19.7145 17.5026C19.2925 18.4836 18.4845 19.2246 17.4665 19.5486C17.0145 19.6936 16.5405 19.7556 16.0675 19.7556H7.6865C6.8525 19.7556 6.1145 19.5616 5.5095 19.1976C5.1305 18.9696 5.0635 18.4446 5.3445 18.1026C5.8145 17.5326 6.2785 16.9606 6.7465 16.3836C7.6385 15.2796 8.2395 14.9596 8.9075 15.2406C9.1785 15.3566 9.4505 15.5316 9.7305 15.7156C10.4765 16.2096 11.5135 16.8876 12.8795 16.1516C13.8132 15.641 14.3552 14.7673 14.827 14.0069L14.8365 13.9916C14.8682 13.9407 14.8997 13.8898 14.9311 13.8391C15.0915 13.5799 15.2495 13.3246 15.4285 13.0896C15.6505 12.7986 16.4745 11.8886 17.5395 12.5366C18.2185 12.9446 18.7895 13.4966 19.4005 14.0876Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="w-100 ">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ __('global-message.image') }}</h6>
                                        <p>{{ formatSizeUnits($storage['imagens']['size']) }}</p>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 8px">
                                        <div class="progress-bar bg-warning" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="{{ $storage['total'] > 0 ? ($storage['imagens']['size'] / $storage['total']) * 100 : 0 }}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{ $storage['total'] > 0 ? ($storage['imagens']['size'] / $storage['total']) * 100 : 0 }}%; transition: width 2s ease 0s;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <span class="avatar-50 bg-soft-primary rounded">
                                    <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z"
                                                fill="currentColor"></path>
                                        </svg>
                                </span>
                                <div class="w-100 ">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ __('global-message.other') }}</h6>
                                        <p>{{ formatSizeUnits($storage['others']['size']) }}</p>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 8px">
                                        <div class="progress-bar bg-danger" data-toggle="progress-bar"
                                            role="progressbar" aria-valuenow="{{ $storage['total'] > 0 ? ($storage['others']['size'] / $storage['total']) * 100 : 0 }}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{ $storage['total'] > 0 ? ($storage['others']['size'] / $storage['total']) * 100 : 0 }}%; transition: width 2s ease 0s;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx = document.getElementById('chart');
      
        const data = {
            labels: [
                '{{ __('global-message.used') }}',
                '{{ __('global-message.free') }}'
            ],
            datasets: [{
                data: [{{ $storage['used'] }}, {{ $storage['total'] - $storage['used'] }}],
                backgroundColor: [
                'rgb(0, 0, 255)',
                'rgb(192, 192, 192)'
                ],
                hoverOffset: 2
            }]
        };

        new Chart(ctx, {
          type: 'doughnut',
          data: data,
        });
      </script>
      

</x-app-layout>
