@auth
    <a class="btn btn-soft-primary btn-icon rounded-pill" onclick="favority()">
        <i class="{{ Auth::user()->favorities()->wherePivot('repository_id', $repository->id)->exists() ? "fa-solid fa-heart" : "fa-regular fa-heart" }}" id="favorityButton"></i>
    </a>
        
    <script>
        function favority() {
            const token = '{{ csrf_token() }}';
            fetch('{{ route('favorities.store') }}', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': token
                    },
                    body: JSON.stringify({
                        _token: token,
                        repository_id: {{ $repository->id }}
                    })
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    const favorityButton = document.querySelector('#favorityButton');
                    if (json.action == 'create') {
                        favorityButton.classList= 'fa-solid fa-heart';
                    } else {
                        favorityButton.classList = 'fa-regular fa-heart';
                    }
                })
                .catch(error => console.error(error));
        }
    </script>
@endauth
