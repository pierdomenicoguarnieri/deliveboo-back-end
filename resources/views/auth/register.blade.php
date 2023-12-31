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
          <h4>Registrati</h4>

          <div class="card-body">
            <form onsubmit="return convalidaForm(this)" method="POST" action="{{ route('register') }}">
              @csrf

              <div class="mb-4 row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                <div class="col-md-8">
                  <input onkeyup="valideInput(this)" id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                  <div id="errorName"></div>
                </div>
              </div>

              <div class="mb-4 row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                <div class="col-md-8">
                  <input onkeyup="valideInput(this)" id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                  <div id="errorEmail"></div>
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                <div class="col-md-8">
                  <input onkeyup="valideInput(this)" id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror

                  <div id="errorPass"></div>
                </div>
              </div>

              <div class="mb-4 row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">Conferma password</label>

                <div class="col-md-8">
                  <input onkeyup="valideInput(this)"  id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    autocomplete="new-password">
                </div>
              </div>

              <div class="mb-4 row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-outline-primary boo-btn">
                    Registrati
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
let errors = [];
let message;
let condition;
let pass;
let newPass;

function valideInput(input) {
  if (input.id == 'name') {
    document.getElementById('errorName').innerHTML = '';
    controll(input.value.length === 0, 'Il nome è un campo obbligatorio', 'errorName');
    controll(input.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
  }
  if (input.id == 'email') {
    document.getElementById('errorEmail').innerHTML = '';
    controll(input.value.length === 0, 'L\'email è un campo obbligatorio', 'errorEmail')
    controll(input.value.length > 255, 'L\'email deve avere un massimo di 255 caratteri', 'errorEmail')
  }
  if (input.id == 'password') {
    document.getElementById('errorPass').innerHTML = '';
    controll(input.value.length === 0, 'La password è un campo obbligatorio', 'errorPass')
    controll(input.value.length > 0 && input.value.length < 8, 'La password deve avere almeno 8 caratteri', 'errorPass')
    controll(input.value != newPass, 'La conferma della password non corrisponde', 'errorPass')
    controll(input.value.length > 0 && input.value.length < 8 && input.value != newPass, 'La password deve avere almeno 8 caratteri e la conferma della password non corrisponde', 'errorPass')
    pass = input.value;
  }
  if (input.id == 'password-confirm') {
    document.getElementById('errorPass').innerHTML = '';
    controll(input.value != pass, 'La conferma della password non corrisponde', 'errorPass')
    controll(pass.length > 0 && pass.length < 8, 'La password deve avere almeno 8 caratteri', 'errorPass')
    controll(pass.length > 0 && pass.length < 8 && input.value != pass, 'La password deve avere almeno 8 caratteri e la conferma della password non corrisponde', 'errorPass')
    newPass = input.value;
  }
}

function convalidaForm(formData) {

  condition = true;
  reset();

  //controlli di validazione

  controll(formData.name.value.length === 0, 'Il nome è un campo obbligatorio', 'errorName')
  controll(formData.name.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
  controll(formData.email.value.length === 0, 'L\'email è un campo obbligatorio', 'errorEmail')
  controll(formData.email.value.length > 255, 'L\'email deve avere un massimo di 255 caratteri', 'errorEmail')
  controll(formData.password.value.length === 0, 'La password è un campo obbligatorio', 'errorPass')
  controll(formData.password.value.length > 0 && formData.password.value.length < 8, 'La password deve avere almeno 8 caratteri', 'errorPass')
  controll(formData.password_confirmation.value != formData.password.value, 'La conferma della password non corrisponde', 'errorPass')
  controll(formData.password.value.length > 0 && formData.password.value.length < 8 && formData.password_confirmation.value != formData.password.value, 'La password deve avere almeno 8 caratteri e la conferma della password non corrisponde', 'errorPass')

  return condition;
}

function controll(cond, msg, id) {
  if (cond) {
    message = msg;
    document.getElementById(id).innerHTML = `<span class="text-danger">${message}</span>`;
    condition = false;
  }
}

function reset() {
  document.getElementById('errorName').innerHTML = '';
  document.getElementById('errorEmail').innerHTML = '';
  document.getElementById('errorPass').innerHTML = '';
}
</script>

@endsection
