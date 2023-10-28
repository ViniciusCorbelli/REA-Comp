@auth
    <a class="btn btn-soft-primary btn-icon rounded-pill" onclick="favority()"><img id="favorityButton" class="rounded img-fluid avatar-40 me-3"
            src="{{ '/images/icons/' .(Auth::user()->favorities()->wherePivot('repository_id', $repository->id)->exists()? 'heart_filled': 'heart_suit') .'.svg' }}"></a>

    <script>
        function favority() {
            const token = '{{ csrf_token() }}';
            fetch('{{ route('favorities.store') }}', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": token
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
                        favorityButton.setAttribute('src', '/images/icons/heart_filled.svg');
                    } else {
                        favorityButton.setAttribute('src', '/images/icons/heart_suit.svg');
                    }
                })
                .catch(error => console.error(error));
        }
    </script>
@endauth
