<x-app-layout :assets="$assets ?? []">
    <div>
        <?php
        $id = $id ?? null;
        ?>
        @if (isset($id))
            {!! Form::model($data, [
                'route' => ['users.update', $id],
                'method' => 'patch',
                'enctype' => 'multipart/form-data',
            ]) !!}
        @else
            {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">
                                {{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('users.title')]) : trans('global-message.add_form_title', ['form' => trans('users.title')]) }}
                            </h4>
                        </div>
                        @can('view', $data)
                            <div class="card-action">
                                <a href="{{ route('users.show', $id) }}" class="btn btn-sm btn-primary"
                                    role="button">{{ __('global-message.back') }}</a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fname">{{ __('users.first_name') }}: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lname">{{ __('users.last_name') }}: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">{{ __('users.email') }}: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3">{{ __('users.security') }}</h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pass">{{ __('users.password') }}:</label>
                                    <div class="input-group">
                                        {{ Form::password('password', ['class' => 'form-control password']) }}
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="width: 100%;height: 100%;">
                                                <i class="fa-solid fa-eye fa-lg" onclick="hideShowPassword(this, 'password')"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pass">{{ __('users.repeat_password') }}:</label>
                                    <div class="input-group">
                                        {{ Form::password('password_confirmation', ['class' => 'form-control password_confirmation']) }}
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="width: 100%;height: 100%;">
                                                <i class="fa-solid fa-eye fa-lg" onclick="hideShowPassword(this, 'password_confirmation')"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ $id !== null ? __('global-message.update') : __('global-message.save') }}
                                {{ __('users.title') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
