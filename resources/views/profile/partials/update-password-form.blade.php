<section>
    <div class="container mt-5">
        <h2 class="text-lg font-medium text-dark">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-secondary">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-5 container space-y-5">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @if($errors->has('updatePassword.current_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('updatePassword.current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
            @if($errors->has('updatePassword.password'))
                <div class="invalid-feedback">
                    {{ $errors->first('updatePassword.password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @if($errors->has('updatePassword.password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('updatePassword.password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
        @if (session('status') === 'profile-updated')
            <p class="text-sm mt-3 ps-2 text-secondary">
                {{ __('Saved') }}
            </p>
        @endif
    </form>
</section>
