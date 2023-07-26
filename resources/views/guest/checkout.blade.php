@extends('layouts.guest')

@section('content')
  <div class="col-md-6 offset-md-3">
    <h1>Payment Form</h1>
    <div class="spacer"></div>

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
    <form action="{{route('checkout')}}" method="POST" id="payment-form" onsubmit="return convalidaForm(this)">
        @csrf

        <div class="mb-3">
          <label for="user_name" class="form-label">Nome</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control @error('name') form-invalid @enderror"
            name="user_name"
            placeholder="Mario"
            id="user_name"
            value="{{ old('user_name') }}">

          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorName"></div>
        </div>

        <div class="mb-3">
          <label for="user_lastname" class="form-label">Cognome</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control @error('user_lastname') form-invalid @enderror"
            name="user_lastname"
            placeholder="Rossi"
            id="user_lastname"
            value="{{ old('user_lastname') }}">

          @error('user_lastname')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorLastName"></div>
        </div>

        <div class="mb-3">
          <label for="user_email" class="form-label">Email</label>
          <input
            onkeyup="valideInput(this)"
            type="email"
            class="form-control @error('user_email') form-invalid @enderror"
            placeholder="Email"
            name="user_email"
            id="user_email"
            value="{{ old('user_email') }}">

          @error('user_email')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorEmail"></div>
        </div>

        <div class="mb-3">
          <label for="user_telephone_number" class="form-label">Numero di telefono</label>
          <input
            onkeyup="valideInput(this)"
            type="number"
            min="0"
            id="user_telephone_number"
            placeholder="1234567890"
            pattern="[0-9]{10}"
            class="form-control @error('user_telephone_number') form-invalid @enderror"
            name="user_telephone_number"
            id="user_telephone_number"
            value="{{ old('user_telephone_number') }}">

          @error('user_telephone_number')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorNumber"></div>
        </div>

        <div class="mb-3">
          <label for="user_address" class="form-label">Indirizzo</label>
          <input
            onkeyup="valideInput(this)"
            type="text"
            class="form-control @error('user_address') form-invalid @enderror"
            placeholder="Idirizzo"
            name="user_address"
            id="user_address"
            value="{{ old('user_address') }}">

          @error('user_address')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="errorAddress"></div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" class="form-control" id="amount" name="amount" value="{{number_format($data->total_price, 2)}}" readonly>
              </div>
          </div>
      </div>

        <div class="row">
            <div class="col-md-6">
                <label for="cc_number">Credit Card Number</label>

                <div class="form-group" id="card-number">

                </div>
            </div>

            <div class="col-md-3">
                <label for="expiry">Expiry</label>

                <div class="form-group" id="expiration-date">

                </div>
            </div>

            <div class="col-md-3">
                <label for="cvv">CVV</label>

                <div class="form-group" id="cvv">

                </div>
            </div>

        </div>

        <div class="spacer"></div>

        <div id="paypal-button"></div>

        <div class="spacer"></div>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button type="submit" class="btn btn-success">Submit Payment</button>
    </form>
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
  placeholder: '10/2019'
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
  currency: 'USD', // Required
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
  body {
      margin: 24px 0;
  }
  .spacer {
      margin-bottom: 24px;
  }

  #card-number, #cvv, #expiration-date {
      background: white;
      height: 38px;
      border: 1px solid #CED4DA;
      padding: .375rem .75rem;
      border-radius: .25rem;
  }
</style>
@endsection
