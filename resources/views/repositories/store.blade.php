@extends('layouts.app')

@section('content')

    <style>
        .card-footer,
        .progress {
            display: none;
        }
    </style>

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Envie o arquivo</h5>
                    </div>

                    <div class="card-body">
                        <div id="upload-container" class="text-center">
                            <button id="browseFile" class="btn btn-primary">Procure o arquivo</button>
                        </div>
                        <div class="progress mt-3" style="height: 25px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%; height: 100%">
                                0%</div>
                        </div>
                    </div>

                    <div class="card-footer p-4">
                        <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript">
        let browseFile = document.getElementById('browseFile');
        let resumable = new Resumable({
            target: '{{ route('upload') }}',
            query: {
                _token: '{{ csrf_token() }}'
            },
            fileType: ['mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile);

        resumable.on('fileAdded', function(file) {
            showProgress();
            resumable.upload()
        });

        resumable.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            document.getElementById('videoPreview').src = response.path;
            document.querySelector('.card-footer').style.display = 'block';
        });

        resumable.on('fileError', function(file, response) {
            alert('file uploading error.');
        });

        let progress = document.querySelector('.progress');

        function showProgress() {
            progress.querySelector('.progress-bar').style.width = '0%';
            progress.querySelector('.progress-bar').textContent = '0%';
            progress.querySelector('.progress-bar').classList.remove('bg-success');
            progress.style.display = 'block';
        }

        function updateProgress(value) {
            progress.querySelector('.progress-bar').style.width = value + '%';
            progress.querySelector('.progress-bar').textContent = value + '%';
        }

        function hideProgress() {
            progress.style.display = 'none';
        }
    </script>

@stop
