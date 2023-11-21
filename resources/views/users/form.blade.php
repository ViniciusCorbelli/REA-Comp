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
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('users.title')]) : trans('global-message.add_form_title', ['form' => trans('users.title')]) }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img src="{{ asset('images/avatars/01.png') }}" alt="User-Profile"
                                    class="profile-pic rounded avatar-100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('users.status') }}:</label>
                            <div class="grid" style="--bs-gap: 1rem">
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'active', old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']) }}
                                    <label class="form-check-label" for="status-active">
                                        {{ __('users.active') }}
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'pending', old('status'), ['class' => 'form-check-input', 'id' => 'status-pending']) }}
                                    <label class="form-check-label" for="status-pending">
                                        {{ __('users.pending') }}
                                    </label>
                                </div>
                                <div class="form-check g-col-6">
                                    {{ Form::radio('status', 'inactive', old('status'), ['class' => 'form-check-input', 'id' => 'status-inactive']) }}
                                    <label class="form-check-label" for="status-inactive">
                                        {{ __('users.inactive') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $id !== null ? trans('global-message.update_form_title', ['form' => trans('users.title')]) : trans('global-message.add_form_title', ['form' => trans('users.title')]) }}</h4>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary"
                                role="button">{{ __('global-message.back') }}</a>
                        </div>
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
                                    <label class="form-label" for="phone_number">{{ __('users.phone_number') }}:</label>
                                    {{ Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'id' => 'phone_number']) }}
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
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="uname">{{ __('users.user_name') }}: <span
                                            class="text-danger">*</span></label>
                                    {{ Form::text('username', old('username'), ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pass">{{ __('users.password') }}:</label>
                                    {{ Form::password('password', ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="rpass">{{ __('users.repeat_password') }}:</label>
                                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
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
