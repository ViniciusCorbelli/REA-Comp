@foreach ($repository->comments()->get() as $comment)
    <div class="card shadow-none bg-transparent border">
        <div class="card-body">
            <div class="d-flex flex-sm-nowrap flex-wrap">
                <div class="ms-0 ms-sm-3" style="width: 100%">
                    <div class="d-flex justify-content-between align-items-center my-2 my-lg-0">
                        <h6 class="mb-0">{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</h6>
                        @auth
                            <div style="display: ruby;">
                                @can('update', $comment)
                                    <div id="comment-actions-{{ $comment->id }}">
                                        <a class="btn btn-primary btn-icon btn-sm rounded-pill" href="javascript:void(0)"
                                            role="button" onclick="editComment({{ $comment->id }})">
                                            <span class="btn-inner">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </span>
                                        </a>
                                    </div>
                                @endcan
                                @can('delete', $comment)
                                    <a class="btn btn-primary btn-icon btn-sm rounded-pill" href="javascript:void(0)"
                                        role="button" onclick="deleteComment({{ $comment->id }})">
                                        <span class="btn-inner">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    </a>
                                @endcan
                            </div>
                        @endauth
                    </div>
                    <small class="text-primary">{{ __('global-message.created_on') }}
                        {{ date('d F, Y', strtotime($comment->created_at)) }}</small>
                    <p class="mt-2 mb-0" id="comment-{{ $comment->id }}">{{ $comment->message }}</p>


                    @auth
                        <a class="btn btn-soft-primary btn-icon rounded-pill"
                            onclick="favorityComment({{ $comment->id }})">
                            <i class="{{ Auth::user()->favoritiesComments()->wherePivot('comment_id', $comment->id)->exists()? 'fa-solid fa-heart': 'fa-regular fa-heart' }}"
                                id="favorityButton_{{ $comment->id }}"></i>
                            <small id="favorityCount_{{ $comment->id }}">{{ $comment->favorities()->count() }}</small>
                        </a>

                        <script>
                            function favorityComment(id) {
                                const token = '{{ csrf_token() }}';
                                fetch('{{ route('favorities.comment.store') }}', {
                                        method: 'post',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-Token': token
                                        },
                                        body: JSON.stringify({
                                            _token: token,
                                            comment_id: id,
                                        })
                                    })
                                    .then(response => {
                                        return response.json();
                                    })
                                    .then(json => {
                                        const favorityButton = document.querySelector('#favorityButton_' + id);
                                        const favorityCountElement = document.querySelector('#favorityCount_' + id);

                                        if (json.action == 'create') {
                                            favorityButton.classList = 'fa-solid fa-heart';
                                            favorityCountElement.innerText = parseInt(favorityCountElement.innerText) + 1;
                                        } else {
                                            favorityButton.classList = 'fa-regular fa-heart';
                                            favorityCountElement.innerText = parseInt(favorityCountElement.innerText) - 1;
                                        }
                                    })
                                    .catch(error => console.error(error));
                            }
                        </script>
                    @else
                        <a class="rounded-pill">
                            <i class="fa-regular fa-heart"></i>
                            <small>{{ $comment->favorities()->count() }}</small>
                        </a>

                    @endauth

                </div>
            </div>
        </div>
    </div>
@endforeach

@auth
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="message" class="form-label">{{ __('comments.title') }}</label>
                <textarea class="form-control" rows="2" id="message"></textarea>
            </div>
        </div>
        <div class="d-flex">
            <button onclick="sendComment()" class="btn btn-primary">{{ __('comments.button') }}</button>
        </div>
    </div>
@endauth

<script>
    function sendComment() {
        const token = '{{ csrf_token() }}';
        fetch('{{ route('comments.store') }}', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                },
                body: JSON.stringify({
                    _token: token,
                    repository_id: {{ $repository->id }},
                    message: document.getElementById('message').value
                })
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                location.reload()
            })
            .catch(error => console.error(error));
    }

    function editComment(id) {
        console.log(id);
        const commentText = document.getElementById('comment-' + id).innerText;
        const textarea = document.createElement('textarea');
        textarea.className = 'form-control';
        textarea.rows = 5;
        textarea.id = 'message-' + id;
        textarea.value = commentText;

        const commentElement = document.getElementById('comment-' + id);
        commentElement.replaceWith(textarea);

        const commentActions = document.getElementById('comment-actions-' + id);
        const editButtons = commentActions.innerHTML;

        commentActions.innerHTML = `
            <a class="btn btn-success btn-icon btn-sm rounded-pill" href="javascript:void(0)" role="button" onclick="updateComment(${id})">
                <span class="btn-inner">
                    <i class="fa-solid fa-check"></i>
                </span>
            </a>
        `;
    }

    function updateComment(id) {
        const token = '{{ csrf_token() }}';
        fetch('{{ route('comments.update', '') }}/' + id, {
                method: 'put',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                },
                body: JSON.stringify({
                    _token: token,
                    repository_id: {{ $repository->id }},
                    message: document.getElementById('message-' + id).value
                })
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                location.reload()
            })
            .catch(error => console.error(error));
    }

    function deleteComment(id) {
        const token = '{{ csrf_token() }}';
        fetch('{{ route('comments.destroy', '') }}/' + id, {
                method: 'delete',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                },
                body: JSON.stringify({
                    _token: token,
                })
            })
            .then(response => {
                return response.json();
            })
            .then(json => {
                location.reload()
            })
            .catch(error => console.error(error));
    }
</script>
