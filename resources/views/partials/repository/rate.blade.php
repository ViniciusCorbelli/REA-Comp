@auth
    <form id="rating-form">
        <div class="form-group row">
            <div class="col">
                <div class="rate">
                    @php
                        $score = Auth::user()
                            ->rates()
                            ->where('repository_id', $repository->id)
                            ->value('score');
                    @endphp
                    @for ($i = 5; $i > 0; $i--)
                        <input type="radio" {{ $i == $score ? 'checked' : '' }} id="star{{ $i }}" class="rate"
                            name="rating" value="{{ $i }}" />
                        <label for="star{{ $i }}" title="text">{{ $i }} stars</label>
                    @endfor
                </div>
                <label>{{ number_format($repository->rates()->avg('score'), 2) }}</label>
            </div>
        </div>
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingForm = document.getElementById('rating-form');
            const radioInputs = ratingForm.querySelectorAll('input[type="radio"]');

            radioInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    const score = input.value;
                    rating(score);
                });
            });
        });

        function rating(score) {
            const token = '{{ csrf_token() }}';
            fetch('{{ route('ratings.store') }}', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": token
                    },
                    body: JSON.stringify({
                        _token: token,
                        repository_id: {{ $repository->id }},
                        score: score
                    })
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    if (json.action == 'delete') {
                        const ratingForm = document.getElementById('rating-form');
                        const radioInputs = ratingForm.querySelectorAll('input[type="radio"]');

                        radioInputs.forEach(function(input) {
                            input.checked = false;
                        });
                    }
                })
                .catch(error => console.error(error));
        }
    </script>
@else
    <div class="form-group row">
        <div class="col">
            <div class="rate">
                @php
                    $score = $repository->rates()->avg('score');
                    $scoreSelect = (int) $score;
                @endphp
                @for ($i = 5; $i > 0; $i--)
                    <label for="star{{ $i }}" title="text" class="{{ $i <= $scoreSelect ? 'rated-user' : '' }}">{{ $i }} stars</label>
                @endfor
            </div>
            <label>{{ number_format($score, 2) }}</label>
        </div>
    </div>
@endauth
