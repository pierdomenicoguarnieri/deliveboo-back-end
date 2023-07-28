@extends('layouts.guest')

@section('content')
<div class="container boo-wrapper d-flex flex-wrap flex-row">
  <div class="cart-container w-100 mb-5">
    <div class="content-wrapper rounded-5 bg-transparent border border-2 py-5 px-3">
      <h2 class="mb-4">Resoconto dell'ordine.</h2>

      <p class="fw-bold fs-5">Ristorante: <span class="fw-normal">{{$data->restaurant_name}}</span></p>
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="bg-transparent w-25">Nome piatto</th>
            <th scope="col" class="bg-transparent text-center">Quantità</th>
            <th scope="col" class="bg-transparent text-center">Totale</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data->dishes as $dish)
            <tr>
              <th scope="row" class="bg-transparent">{{$dish->dish->name}}</th>
              <td class="bg-transparent text-center">{{$dish->counterQuantity}}</td>
              <td class="bg-transparent text-center">&euro; {{number_format(($dish->dish->price) * $dish->counterQuantity, 2) }}</td>
            </tr>
          @endforeach
          <tr>
            <th scope="row" class="bg-transparent"></th>
            <td class="bg-transparent"></td>
            <td class="bg-transparent text-center">&euro; {{number_format($data->total_price, 2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="form-wrapper h-100 w-100 px-2 mb-0">
    <div class="d-flex align-items-center justify-content-between">
      <h1 class="mb-3">Modalità di pagamento</h1>
      <a class="custom-btn-back text-decoration-none" href="{{ url('/') }}">Torna indietro</a>
    </div>

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('checkout')}}" method="POST" id="payment-form">
        @csrf

        <div class="mb-3">
          <label for="user_name" class="form-label fw-bold">Nome</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control boo-form @error('name') form-invalid @enderror"
            name="user_name"
            id="user_name"
            value="{{ old('user_name') }}"
            required>

          @error('user_name')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorName"></div>
        </div>

        <div class="mb-3">
          <label for="user_lastname" class="form-label fw-bold">Cognome</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control boo-form @error('user_lastname') form-invalid @enderror"
            name="user_lastname"
            id="user_lastname"
            value="{{ old('user_lastname') }}"
            required>

          @error('user_lastname')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorLastName"></div>
        </div>

        <div class="mb-3">
          <label for="user_email" class="form-label fw-bold">Email</label>
          <input
            onkeyup="valideInput(this)"
            type="email"
            class="form-control boo-form @error('user_email') form-invalid @enderror"
            name="user_email"
            id="user_email"
            value="{{ old('user_email') }}"
            required>

          @error('user_email')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorEmail"></div>
        </div>

        <div class="mb-3">
          <label for="user_telephone_number" class="form-label fw-bold">Numero di telefono</label>
          <input
            onkeyup="valideInput(this)"
            type="number"
            min="0"
            id="user_telephone_number"
            pattern="[0-9]{10}"
            class="form-control boo-form @error('user_telephone_number') form-invalid @enderror"
            name="user_telephone_number"
            id="user_telephone_number"
            value="{{ old('user_telephone_number') }}"
            required>

          @error('user_telephone_number')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorNumber"></div>
        </div>

        <div class="mb-3">
          <label for="user_address" class="form-label fw-bold">Indirizzo</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control boo-form @error('user_address') form-invalid @enderror"
            name="user_address"
            id="user_address"
            value="{{ old('user_address') }}"
            required>

          @error('user_address')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorAddress"></div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="amount fw-bold">Totale ordine</label>
              <div class="input-group">

                  <span class="input-group-text">&euro; {{number_format($data->total_price, 2)}}</span>
                  <input type="text" class="form-control" id="amount" name="amount" value="{{number_format($data->total_price, 2)}}" hidden>
              </div>
          </div>
      </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cc_number fw-bold">Numero carta di credito</label>

                <div class="form-group" id="card-number">

                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="expiry fw-bold">Data di scadenza</label>

                <div class="form-group" id="expiration-date">

                </div>
            </div>

            <div class="col-md-3 mb-3">
                <label for="cvv fw-bold">CVV</label>

                <div class="form-group" id="cvv">

                </div>
            </div>

        </div>

        <div id="paypal-button"></div>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button type="submit" class="custom-btn-checkout mt-3">Acquista ora</button>
    </form>
  </div>
</div>
<script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>

<!-- Load PayPal's checkout.js Library. -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>

<!-- Load the PayPal Checkout component. -->
<script src="https://js.braintreegateway.com/web/3.38.1/js/paypal-checkout.min.js"></script>
<script>

var form = document.querySelector('#payment-form');
var submit = document.querySelector('input[type="submit"]');

braintree.client.create({
authorization: '{{ $token }}'
}, function (clientErr, clientInstance) {
if (clientErr) {
console.error(clientErr);
return;
}

// This example shows Hosted Fields, but you can also use this
// client instance to create additional components here, such as
// PayPal or Data Collector.

braintree.hostedFields.create({
client: clientInstance,
styles: {
'input': {
  'font-size': '14px'
},
'input.invalid': {
  'color': 'red'
},
'input.valid': {
  'color': 'green'
}
},
fields: {
number: {
  selector: '#card-number',
  placeholder: '4111 1111 1111 1111'
},
cvv: {
  selector: '#cvv',
  placeholder: '123'
},
expirationDate: {
  selector: '#expiration-date',
  placeholder: '10/2023'
}
}
}, function (hostedFieldsErr, hostedFieldsInstance) {
if (hostedFieldsErr) {
console.error(hostedFieldsErr);
return;
}

// submit.removeAttribute('disabled');

form.addEventListener('submit', function (event) {
event.preventDefault();

hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
  if (tokenizeErr) {
    console.error(tokenizeErr);
    return;
  }

  // If this was a real integration, this is where you would
  // send the nonce to your server.
  // console.log('Got a nonce: ' + payload.nonce);
  document.querySelector('#nonce').value = payload.nonce;
  form.submit();
});
}, false);
});

// Create a PayPal Checkout component.
braintree.paypalCheckout.create({
client: clientInstance
}, function (paypalCheckoutErr, paypalCheckoutInstance) {

// Stop if there was a problem creating PayPal Checkout.
// This could happen if there was a network error or if it's incorrectly
// configured.
if (paypalCheckoutErr) {
console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
return;
}

// Set up PayPal with the checkout.js library
paypal.Button.render({
env: 'sandbox', // or 'production'
commit: true,

payment: function () {
return paypalCheckoutInstance.createPayment({
  // Your PayPal options here. For available options, see
  // http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
  flow: 'checkout', // Required
  amount: 13.00, // Required
  currency: 'EUR', // Required
});
},

onAuthorize: function (data, actions) {
return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
  // Submit `payload.nonce` to your server.
  document.querySelector('#nonce').value = payload.nonce;
  form.submit();
});
},

onCancel: function (data) {
console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
},

onError: function (err) {
console.error('checkout.js error', err);
}
}, '#paypal-button').then(function () {
// The PayPal button will be rendered in an html element with the id
// `paypal-button`. This function will be called when the PayPal button
// is set up and ready to be used.

});

});
});

let errors = [];
    let message;
    let condition;
    let check;

    function valideInput(input) {
      if (input.id == 'user_name') {
        document.getElementById('errorName').innerHTML = '';
        controll(input.value.length === 0, 'Il nome è un campo obbligatorio', 'errorName');
        controll(input.value.length > 0 && input.value.length < 5 , 'Il nome deve avere almeno 5 caratteri', 'errorName')
        controll(input.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
      }
      if (input.id == 'user_lastname') {
        document.getElementById('errorLastName').innerHTML = '';
        controll(input.value.length === 0, 'Il cognome è un campo obbligatorio', 'errorLastName');
        controll(input.value.length > 0 && input.value.length < 5 , 'Il cognome deve avere almeno 5 caratteri', 'errorLastName')
        controll(input.value.length > 255, 'Il cognome può avere un massimo di 255 caratteri', 'errorLastName')
      }
      if (input.id == 'user_email') {
        document.getElementById('errorEmail').innerHTML = '';
        controll(input.value.length === 0, 'L\'email è un campo obbligatorio', 'errorEmail')
        controll(input.value.length > 0 && input.value.length < 5 , 'L\'email deve avere almeno 5 caratteri', 'errorEmail')
        controll(input.value.length > 255, 'L\'email deve avere un massimo di 255 caratteri', 'errorEmail')
      }
      if (input.id == 'user_address') {
        document.getElementById('errorAddress').innerHTML = '';
        controll(input.value.length === 0, 'L\'indirizzo è un campo obbligatorio', 'errorAddress')
        controll(input.value.length > 0 && input.value.length < 5 , 'L\'indirizzo deve avere almeno 5 caratteri', 'errorAddress')
        controll(input.value.length > 255, 'L\'indirizzo può avere un massimo di 255 caratteri', 'errorAddress')
      }
      if (input.id == 'user_telephone_number') {
        document.getElementById('errorNumber').innerHTML = '';
        controll(input.value === '', 'Il numero di telefono è un campo obbligatorio', 'errorNumber')
      }
    }

    function convalidaForm(formData) {

      let errorsList = document.getElementById("errorsList");
      errorsList.innerHTML = '';
      errors = [];
      condition = true;
      check = false;
      reset();

      //controlli di validazione e stampa errori singoli

      controll(formData.user_name.value.length === 0, 'Il nome è un campo obbligatorio', 'errorName')
      controll(formData.user_name.value.length > 0 && formData.name.value.length < 5 , 'Il nome deve avere almeno 5 caratteri', 'errorName')
      controll(formData.user_name.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
      controll(formData.user_lastname.value.length === 0, 'Il cognome è un campo obbligatorio', 'errorName')
      controll(formData.user_lastname.value.length > 0 && formData.name.value.length < 5 , 'Il nome cognome avere almeno 5 caratteri', 'errorName')
      controll(formData.user_lastname.value.length > 255, 'Il cognome può avere un massimo di 255 caratteri', 'errorName')
      controll(formData.user_email.value.length === 0, 'L\'email è un campo obbligatorio', 'errorEmail')
      controll(formData.user_email.value.length > 0 && formData.email.value.length < 5 , 'L\'email deve avere almeno 5 caratteri', 'errorEmail')
      controll(formData.user_email.value.length > 255, 'L\'email può avere un massimo di 255 caratteri', 'errorEmail')
      controll(formData.user_address.value.length === 0, 'L\'indirizzo è un campo obbligatorio', 'errorAddress')
      controll(formData.user_address.value.length > 0 && formData.address.value.length < 5 , 'L\'indirizzo deve avere almeno 5 caratteri', 'errorAddress')
      controll(formData.user_address.value.length > 255, 'L\'indirizzo può avere un massimo di 255 caratteri', 'errorAddress')

      //stampa lista errori

      if (errors.length > 0) {

        let liErrors = '';
        errors.forEach((error) => {
          liErrors += `<li>${error}</li>`
        });

        errorsList.innerHTML += `
          <div class="d-flex justify-content-start">
            <div class="alert alert-danger py-1" role="alert">
              <ul class="mb-0">
                ${liErrors}
              </ul>
            </div>
          </div>`
      }

      return condition;
    }

    function controll(cond, msg, id) {
      if (cond) {
        message = msg;
        errors.push(message);
        document.getElementById(id).innerHTML = `<span class="text-danger">${message}</span>`;
        condition = false;
      }
    }

    function reset() {
      document.getElementById('errorName').innerHTML = '';
      document.getElementById('errorLastName').innerHTML = '';
      document.getElementById('errorEmail').innerHTML = '';
      document.getElementById('errorAddress').innerHTML = '';
      document.getElementById('errorIva').innerHTML = '';
    }
</script>

<style>
  #card-number, #cvv, #expiration-date {
      background: white;
      height: 38px;
      border: 1px solid #CED4DA;
      padding: .375rem .75rem;
      border-radius: .25rem;
  }
</style>
@endsection
