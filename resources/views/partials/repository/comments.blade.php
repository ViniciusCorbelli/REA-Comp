@foreach ($repository->comments()->get() as $comment)
    <div class="card shadow-none bg-transparent border">
        <div class="card-body">
            <div class="d-flex flex-sm-nowrap flex-wrap">
                <div>
                    <img class="img-fluid object-contain avatar-120 rounded" src="{{ asset('images/avatars/01.png') }}"
                        loading="lazy">
                </div>
                <div class="ms-0 ms-sm-3" style="width: 100%">
                    <div class="d-flex justify-content-between align-items-center my-2 my-lg-0">
                        <h6 class="mb-0">{{ $comment->user->username }}</h6>
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
                </div>
            </div>
        </div>
    </div>
@endforeach

@auth
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="message" class="form-label">{{ __('comments.title') }}<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" rows="5" id="message"></textarea>
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
                    "X-CSRF-Token": token
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
                    "X-CSRF-Token": token
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
                    "X-CSRF-Token": token
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
