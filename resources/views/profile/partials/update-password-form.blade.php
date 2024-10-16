<section>
    <!--begin::Password Update-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('Update Password') }}</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <p class="mt-1 text-muted">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>

            <form method="post" action="{{ route('password.update') }}" class="mt-6">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                    @if ($errors->updatePassword->has('current_password'))
                        <div class="text-danger mt-2">
                            {{ $errors->updatePassword->first('current_password') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    @if ($errors->updatePassword->has('password'))
                        <div class="text-danger mt-2">
                            {{ $errors->updatePassword->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <div class="text-danger mt-2">
                            {{ $errors->updatePassword->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-4">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-muted"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Password Update-->
</section>
