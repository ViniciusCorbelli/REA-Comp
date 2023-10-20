<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
        $id = $id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($data, [
                'route' => ['repositories.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['route' => ['repositories.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('repositories.file')]) : trans('global-message.add_form_title', ['form' => trans('repositories.file')]) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-repository-info">
                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                                <thead>
                                    <tr>
                                        <th>{{ __('global-message.name') }}</th>
                                        <th>{{ __('global-message.size') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class='medias'>
                                    @if ($data != null && count($data->files) > 0)
                                        @foreach ($data->files as $media)
                                            <tr id="media-{{ $media->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                                            src="{{ getImage($media->mime_type) }}">
                                                        <h6><a
                                                                href="{{ asset('storage/' . $media->path) }}">{{ $media->file_name }}</a>
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td>{{ formatSizeUnits($media->size) }}</td>
                                                <td>

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="dropdown">
                                                            <svg height="20" viewBox="0 0 5 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg" role="button"
                                                                id="product-view" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <circle cx="2.5" cy="3" r="2.5"
                                                                    fill="currentcolor"></circle>
                                                                <circle cx="2.5" cy="10" r="2.5"
                                                                    fill="currentcolor"></circle>
                                                                <circle cx="2.5" cy="17" r="2.5"
                                                                    fill="currentcolor"></circle>
                                                            </svg>
                                                            <ul class="dropdown-menu" aria-labelledby="product-view">
                                                                <button class="dropdown-item delete-btn"
                                                                    onclick="removeFile({{ $media->id }}, '', {{ $media->id }})">{{ __('global-message.delete') }}</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <label for="browseFile" class="drop-container" id="dropcontainer">
                                <span class="drop-title">{{ __('repositories.drop_files_here') }}</span>
                                {{ __('global-message.or') }}
                                <a for="browseFile" class="btn btn-primary">{{ __('repositories.find') }}</a>
                                <input type="file" id="browseFile" style="display:none">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('repositories.title')]) : trans('global-message.add_form_title', ['form' => trans('repositories.title')]) }}</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('repositories.index') }}" class="btn btn-sm btn-primary"
                                role="button">{{ __('global-message.back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="new-repository-info">

                            <div class="form-group col-md-6">
                                <label class="form-label" for="title">{{ __('repositories.titleRepository') }}: <span
                                        class="text-danger">*</span></label>
                                {{ Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Título', 'required']) }}
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label" for="description">{{ __('repositories.category') }}: <span
                                        class="text-danger">*</span></label>
                                {{ Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group col-md-12">
                                <label class="form-label" for="description">{{ __('repositories.description') }}: <span
                                        class="text-danger">*</span></label>
                                {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ $id !== null ? __('global-message.update') : __('global-message.save') }}
                            {{ __('repositories.title') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="progress-upload" style="display: none">
        <div class="progress-upload-header">
            <span>Status upload</span>

            <div class="progress-upload-item-close">
                <svg x="0px" y="0px" width="14px" height="14px" viewBox="0 0 10 10" focusable="false"
                    fill="currentColor">
                    <polygon class="a-s-fa-Ha-pa"
                        points="10,1.01 8.99,0 5,3.99 1.01,0 0,1.01 3.99,5 0,8.99 1.01,10 5,6.01 8.99,10 10,8.99 6.01,5 ">
                    </polygon>
                </svg>
            </div>
        </div>
        <div class="progress-upload-body">
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript">
        const browseFile = document.getElementById('browseFile');
        const resumable = new Resumable({
            target: '{{ route('fileUpload') . ($data != null && $data->id ? '/' . $data->id : '') }}',
            query: {
                _token: '{{ csrf_token() }}'
            },
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile);
        resumable.assignDrop(document.getElementById('dropcontainer'));

        const dropContainer = document.getElementById("dropcontainer")

        dropContainer.addEventListener("dragover", (e) => {
            e.preventDefault()
        }, false)

        dropContainer.addEventListener("dragenter", () => {
            dropContainer.classList.add("drag-active")
        })

        dropContainer.addEventListener("dragleave", () => {
            dropContainer.classList.remove("drag-active")
        })

        resumable.on('fileAdded', function(file) {
            showProgress(file);
            resumable.upload()
        });

        resumable.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100), file);
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)

            const progressDiv = progress.querySelector('#progress-div-' + file.uniqueIdentifier);
            progressDiv.innerHTML = `<div class="progress-upload-item-status">
                     <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#0F9D58">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                     </svg>
                  </div>`

            progress.querySelector('#file-name-' + file.uniqueIdentifier).innerHTML = `<p id="file-name-` + file
                .uniqueIdentifier + `"><a href="` + response.path + `">` + file.fileName + `</a></p>`;



            const mediaList = `<tr id="media-` + response.file_id + `">
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary" src="` + response.image + `">
                            <h6><a href="` + response.path + `">` + file.fileName + `</a></h6>
                        </div>
                        </td>
                        <td>` + response.size + `</td>
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="dropdown">
                                    <svg height="20" viewBox="0 0 5 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" role="button"
                                        id="product-view" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <circle cx="2.5" cy="3" r="2.5"
                                            fill="currentcolor"></circle>
                                        <circle cx="2.5" cy="10" r="2.5"
                                            fill="currentcolor"></circle>
                                        <circle cx="2.5" cy="17" r="2.5"
                                            fill="currentcolor"></circle>
                                    </svg>
                                    <ul class="dropdown-menu" aria-labelledby="product-view">
                                        <button class="dropdown-item delete-btn"
                                            onclick="removeFile(` + response.file_id + `, '` + response.relative_path +
                `', ` + new Date().getTime() + `)">Deletar</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>`

            const mediasDiv = document.querySelector('.medias');
            mediasDiv.innerHTML = mediasDiv.innerHTML + mediaList;

        });

        resumable.on('fileError', function(file, response) {
            const progressDiv = progress.querySelector('#progress-div-' + file.uniqueIdentifier);
            progressDiv.innerHTML = `<div class="progress-upload-item-status">
                    <svg width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="256" height="256" viewBox="0 0 256 256" xml:space="preserve">
                    <defs>
                    </defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                        <path d="M 13.4 88.492 L 1.508 76.6 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 69.318 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 L 88.492 13.4 c 2.011 2.011 2.011 5.271 0 7.282 L 20.682 88.492 C 18.671 90.503 15.411 90.503 13.4 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <path d="M 69.318 88.492 L 1.508 20.682 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 13.4 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 l 67.809 67.809 c 2.011 2.011 2.011 5.271 0 7.282 L 76.6 88.492 C 74.589 90.503 71.329 90.503 69.318 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                    </svg>
                  </div>`

        });

        let progress = document.querySelector('.progress-upload');

        function showProgress(file) {
            progress.style.display = 'block';

            const htmlToAppend = `
               <div class="progress-upload-item" id="progress-"` + file.uniqueIdentifier + `>
                  <p id="file-name-` + file.uniqueIdentifier + `">` + file.fileName + `</p>

                  <div id="progress-div-` + file.uniqueIdentifier + `">
                     <div class="progress mt-3">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress-bar-` + file
                .uniqueIdentifier + `" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; height: 100%"> 0%</div>
                     </div>
                  </div>
               </div>
               `;

            const progressUploadBody = progress.querySelector(".progress-upload-body");
            progressUploadBody.innerHTML = progressUploadBody.innerHTML + htmlToAppend;

        }

        function updateProgress(value, file) {
            const progressBar = progress.querySelector('#progress-bar-' + file.uniqueIdentifier);
            progressBar.style.width = value + '%';
            progressBar.textContent = value + '%';
        }

        const closeButton = document.querySelector('.progress-upload-item-close');
        const progressUpload = document.querySelector('.progress-upload');
        closeButton.addEventListener('click', function() {
            progressUpload.style.display = 'none';
        });

        function removeFile(id = 0, path, index) {
            const token = '{{ csrf_token() }}';
            fetch('/file/' + id + '?path=' + path, {
                    method: 'delete',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": token
                    }
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    document.getElementById("media-" + index).remove();
                })
                .catch(error => console.error(error));

        }
    </script>

    {!! Form::close() !!}
    </div>
</x-app-layout>
