<x-app-layout layout="simple" :assets="$assets ?? []">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="border-bottom">
                            <div class="d-flex flex-column align-content-between justify-items-center mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h2 class="mb-0">{{ $repository->title }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom">
                            <p class="py-4 mb-0">{{ $repository->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
