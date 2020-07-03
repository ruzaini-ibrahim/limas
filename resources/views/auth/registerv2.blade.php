@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Panel Floating Labels -->
          <div class="panel tilt-form p-3">
            <div class="panel-heading">
              <h3 class="panel-title text-center font-weight-bold">Register</h3>
            </div>
            <div class="panel-body container-fluid">
              <form autocomplete="off" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  <label class="floating-label">{{ __('Name') }}</label>
                  @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                  <label class="floating-label">{{ __('E-Mail Address') }}</label>
                  @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  <label class="floating-label">{{ __('Password') }}</label>
                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  <label class="floating-label">{{ __('Confirm Password') }}</label>
                </div>
                <div class="form-group row mt-5 justify-content-center">
                        <button type="submit" class="btn btn-outline-main btn-block">
                            {{ __('Register') }}
                        </button>
                </div>
                <div class="form-group row mb-0 float-right">
                    <a class="btn btn-link color-main" href="{{ route('login') }}">
                        {{ __('Back >>') }}
                    </a>
                </div>
              </form>
            </div>
          </div>
          <!-- End Panel Floating Labels -->
        </div>
    </div>
</div>

@endsection

@section('scripts')


<script>
</script>

@endsection