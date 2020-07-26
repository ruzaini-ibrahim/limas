@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Panel Floating Labels -->
          <div class="panel tilt-form p-3">
            <div class="panel-heading">
              <h3 class="panel-title text-center font-weight-bold">Admin Login</h3>
            </div>
            <div class="panel-body container-fluid">
              <form method="POST" action="{{ route('admin.loginPost') }}">
                @csrf
                <div class="form-group form-material floating" data-plugin="formMaterial">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                <div class="form-group row">
                    <div class="col-md-12 text-right">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-5 justify-content-between">
                        <button type="submit" class="btn btn-outline-main btn-block">
                            {{ __('Login') }}
                        </button>
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