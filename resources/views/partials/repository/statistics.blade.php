<div class="row">

    @if (count($repository->files) > 0)
        <div class="col-lg-6">
            <h2 class="text-center">{{ __('repositories.chart.downloads.title') }}</h2>
            <canvas id="chart_files"></canvas>
        </div>
    @endif

    <div class="col-lg-6">
        <h2 class="text-center">{{ __('repositories.chart.visits.title') }}</h2>
        <canvas id="chart_visits"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    const ctx_visits = document.getElementById('chart_visits');

    const data_visits = {
        labels: {!! json_encode($dates) !!},
        datasets: [{
            label: '{{ __('repositories.chart.visits.title') }}',
            data: {!! json_encode($visits_quantities) !!},
            borderColor: '{{ $color = randColor() }}',
            backgroundColor: '{{ $color }}',
            pointStyle: 'circle',
            pointRadius: 4,
            pointHoverRadius: 7
        }]
    };

    new Chart(ctx_visits, {
        type: 'line',
        data: data_visits,
        options: {
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ __('repositories.chart.visits.description') }}'
                    },
                }
            }
        },
    });

    const ctx_files = document.getElementById('chart_files');

    const data_files = {
        labels: {!! json_encode($dates) !!},
        datasets: [
            @foreach ($repository->files as $file)
                {
                    label: '{{ $file->file_name }}',
                    data: {!! json_encode($downloads_quantities[$file->id]) !!},
                    borderColor: '{{ $color = randColor() }}',
                    backgroundColor: '{{ $color }}',
                    pointStyle: 'circle',
                    pointRadius: 4,
                    pointHoverRadius: 7
                },
            @endforeach
        ]
    };

    new Chart(ctx_files, {
        type: 'line',
        data: data_files,
        options: {
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ __('repositories.chart.downloads.description') }}'
                    },
                }
            }
        },
    });
</script>
