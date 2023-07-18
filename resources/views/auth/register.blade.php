@extends('layouts.admin')

@section('content')
  <div class="container mt-4">


    @if (session('deleted'))
      <div class="alert alert-success" role="alert">
        {{ session('deleted') }}
      </div>
    @endif
    @if ($errors->any())
    <div class="d-flex justify-content-center">
      <div class="alert alert-danger w-50 py-1" role="alert">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card boo-wrapper border-0">
          <h4>{{ __('Register') }}</h4>

          <div class="card-body">
            <form onsubmit="return convalidaForm(this)" method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-4 row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-8">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-8">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-8">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-8">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    autocomplete="new-password">
                </div>
              </div>

              <div class="mb-4 row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script language="javascript" type="text/javascript">

  function convalidaForm(passwordForm) {

    if (passwordForm.password.value != passwordForm.password_confirmation.value) {
      alert("La passord inserita non coincide con la prima!")
      passwordForm.password.focus()
      passwordForm.password.select()
      return false
    }
    return true
  }
</script>

@endsection
