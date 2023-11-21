<x-app-layout layout="simple" :assets="$assets ?? []">
    <div class="loading" style="display: none">
        <button class="btn btn-primary" type="button" disabled class="loading-buttom">
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            {{ __('global-message.loading') }}
        </button>
    </div>
    <div class="container">
        <nav class="nav navbar navbar-expand-lg navbar-light top-1 rounded">
            <div class="container-fluid">
                <a class="navbar-brand mx-2" href="javascript:void(0)">
                    <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2"
                            transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"></rect>
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2"
                            transform="rotate(-45 7.72803 27.728)" fill="currentColor"></rect>
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2"
                            transform="rotate(45 10.5366 16.3945)" fill="currentColor"></rect>
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2"
                            transform="rotate(45 10.5562 -0.556152)" fill="currentColor"></rect>
                    </svg>
                    <input class="form-control form-control-lg logo-title" type="text" id="search"
                        placeholder="{{ __('index.placeholder') }}" aria-label=".form-control-lg example">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2"
                    aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-2">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
                        <li class="nav-item">
                            {{ Form::select('topic_id', $topics, old('topic_id'), ['class' => 'form-control', 'id' => 'topic_id']) }}
                        </li>
                        <li class="nav-item">
                            <select class="form-control" id="order">
                                <option value="score">{{ __('index.order.score') }}</option>
                                <option value="comments">{{ __('index.order.comments') }}</option>
                                <option value="favorities">{{ __('index.order.favorities') }}</option>
                                <option value="created_at">{{ __('index.order.created_at') }}</option>
                            </select>
                        </li>
                        <li class="nav-item" onclick="search()">
                            <button class="btn btn-success" style="margin-left: 10px">
                                <i class="fa fa-search"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row" id="repositories"></div>
    </div>

    <script>
        const repositories = document.querySelector("#repositories");
        const loading = document.querySelector('.loading');

        function search(page = 1) {
            showLoading();

            const token = '{{ csrf_token() }}';
            fetch('{{ route('search') }}?' + new URLSearchParams({
                    q: document.getElementById("search").value,
                    topic_id: document.getElementById("topic_id").value,
                    order: document.getElementById("order").value,
                    page: page,
                }), {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": token
                    }
                })
                .then(response => {
                    removeLoading();
                    return response.json();
                })
                .then(json => {
                    if (json.data.length == 0) {
                        repositories.innerHTML = `<div class="text-center" style="width: 100%">
                    <div class="card iq-file-manager">
                        <div class="card-body card-thumbnail">
                            <img src="{{ asset('images/error/02.png') }}" class="img-fluid mb-4"
                                style="max-width: 200px">

                            <h1 class="mb-2"> {{ __('index.not_found.title') }}</h1>
                            <p>{{ __('index.not_found.text') }}</p>
                        </div>
                    </div>
                </div>
                `;
                        return;
                    }

                    const htmlToAppend = `<h4>Total de resultados: ` + json.total + `</h4>`

                    repositories.innerHTML = repositories.innerHTML + htmlToAppend;

                    json.data.forEach(function(repository) {
                        showCard(repository)
                    });
                    createPagination(json)

                })
                .catch(error => console.error(error));
        }

        function showLoading() {
            repositories.innerHTML = '';
            loading.style.display = 'block';
        }

        function removeLoading() {
            loading.style.display = 'none';
        }

        function showCard(repository) {
            var dateParts = repository.created_at.split("-");
            var jsDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0, 2));

            const htmlToAppend = `<div class="col">
                <div class="card">
                    <div class="card-body card-thumbnail">
                        <div class="d-flex align-items-center iq-incoming-blogs gap-3">
                            <div class="d-flex flex-column justify-content-center">
                                <small class="text-primary">
                                    ` + formatDateDifference(new Date(), jsDate) + `
                                </small>
                                <a href="repository/` + repository.id +
                `" class="iq-title">
                                    <h4 class="mt-2 mb-3 text-ellipsis short-2" data-bs-toggle="tooltip" data-bs-original-title="` +
                repository.title + `">` + repository.title + `</h4>
                                </a>

                                <div class="form-group row">
                                    <div class="col">
                                        <div class="rate">
                                            <label title="text" class="` + (repository.score >= 5 ? 'rated-user' : '') + `"></label>
                                            <label title="text" class="` + (repository.score >= 4 ? 'rated-user' : '') + `"></label>
                                            <label title="text" class="` + (repository.score >= 3 ? 'rated-user' : '') + `"></label>
                                            <label title="text" class="` + (repository.score >= 2 ? 'rated-user' : '') + `"></label>
                                            <label title="text" class="` + (repository.score >= 1 ? 'rated-user' : '') + `"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="repository/` + repository.id +
                `" data-bs-toggle="tooltip" class="text-body text-ellipsis short-1 fs-6" data-bs-original-title="` +
                repository.topic.name + `">` + repository.topic.name + `</a><span></span>
                                </div>
                                <div class="text show-first-lines">
                                    <p class="my-4 text-ellipsis short-1">` + repository.description + `</p>
                                </div>
                                <div>
                                    <a href="repository/` + repository.id + `" class="btn btn-primary">{{ __('index.more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`

            repositories.innerHTML = repositories.innerHTML + htmlToAppend;
        }

        function createPagination(json) {
            var li = ``;
            json.links.forEach(function(link) {
                classe = 'pointer'
                if (link.active) {
                    classe = 'active'
                }

                var event = ''
                var page = null;
                if (link.url) {
                    var urlParams = new URLSearchParams(new URL(link.url).search);
                    page = urlParams.get('page');
                    event = 'onclick="search(' + page + ')"'
                } else {
                    classe = 'disabled'
                }

                li += `<li class="page-item ` + classe + `" aria-current="page" ` + event + `><span class="page-link">` + link.label + `</span></li>`
            })
            const htmlToAppend = `<nav>
                    <ul class="pagination">
                        ` + li + `
                    </ul>
                </nav>`
            repositories.innerHTML = repositories.innerHTML + htmlToAppend;
        }

        function formatDateDifference(date1, date2) {
            var diff = Math.floor(date1.getTime() - date2.getTime());
            var minute = 1000 * 60;
            var hour = minute * 60;
            var day = hour * 24;
            var week = day * 7;
            var month = day * 30;
            var year = day * 365.25;

            var minutes = Math.floor(diff / minute);
            var hours = Math.floor(diff / hour);
            var days = Math.floor(diff / day);
            var weeks = Math.floor(diff / week);
            var months = Math.floor(diff / month);
            var years = Math.floor(diff / year);

            if (years >= 1) {
                return years + (years === 1 ? " {{ __('index.year') }} {{ __('index.ago') }}" :
                    " {{ __('index.years') }} {{ __('index.ago') }}");
            } else if (months >= 1) {
                return months + (months === 1 ? " {{ __('index.month') }} {{ __('index.ago') }}" :
                    " {{ __('index.months') }} {{ __('index.ago') }}");
            } else if (weeks >= 1) {
                return weeks + (weeks === 1 ? " {{ __('index.week') }} {{ __('index.ago') }}" :
                    " {{ __('index.weeks') }} {{ __('index.ago') }}");
            } else if (days >= 1) {
                return days + (days === 1 ? " {{ __('index.day') }} {{ __('index.ago') }}" :
                    " {{ __('index.days') }} {{ __('index.ago') }}");
            } else if (hours >= 1) {
                return hours + (hours === 1 ? " {{ __('index.hour') }} {{ __('index.ago') }}" :
                    " {{ __('index.hours') }} {{ __('index.ago') }}");
            } else if (minutes >= 1) {
                return minutes + (minutes === 1 ? " {{ __('index.minute') }} {{ __('index.ago') }}" :
                    " {{ __('index.minutes') }} {{ __('index.ago') }}");
            } else {
                return "{{ __('index.moment') }} {{ __('index.ago') }}";
            }
        }
    </script>
</x-app-layout>
