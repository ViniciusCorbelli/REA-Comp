<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
        $id = $id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($data, [
                'route' => ['categories.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['route' => ['categories.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('categories.title')]) : trans('global-message.add_form_title', ['form' => trans('categories.title')]) }}</h4>
                </div>
                <div class="card-action">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary" role="button">{{ __('global-message.back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="name">{{ __('category.name') }}: <span class="text-danger">*</span></label>
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $id !== null ? __('global-message.update') : __('global-message.save') }} {{ __('categories.title') }}</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
