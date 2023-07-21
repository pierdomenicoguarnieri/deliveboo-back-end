@extends('layouts.admin')

@section('content')
  <div class="container boo-wrapper">
    <h1>{{ $title }}</h1>

    @if ($errors->any())
    <div class="alert
    alert-danger" role="alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

 <div id="errorsList"></div>

  <form
    action="{{ $route }}"
    method="POST"
    class="mt-5"
    enctype="multipart/form-data"
    onsubmit="return convalidaForm(this)">
    @csrf
    @method($method)

    <div class="mb-3">
      <label for="name" class="form-label">Nome</label>
      <input
        type="text"
        class="form-control @error('name') is-invalid @enderror"
        name="name"
        placeholder="Nome ristorante"
        id="name"
        value="{{ old('name', $restaurant->name) }}">

      @error('name')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <div id="errorName"></div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        type="email"
        class="form-control @error('email') is-invalid @enderror"
        placeholder="Email ristorante"
        name="email"
        id="email"
        value="{{ old('email', $restaurant->email) }}">

      @error('email')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <div id="errorEmail"></div>
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Indirizzo</label>
      <input
        type="text"
        class="form-control @error('address') is-invalid @enderror"
        placeholder="Restaurant address"
        name="address"
        id="address"
        value="{{ old('address', $restaurant->address) }}">

      @error('address')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <div id="errorAddress"></div>
    </div>

    <div class="mb-3">
      <label for="piva" class="form-label">P. IVA</label>
      <input
        type="number"
        min="10000000000"
        class="form-control @error('piva') is-invalid @enderror"
        placeholder="P. Iva"
        name="piva"
        id="piva"
        value="{{ old('piva', $restaurant->piva) }}">

      @error('piva')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <div id="errorIva"></div>
    </div>

    <div class="mb-3">
      <label for="telephone_number" class="form-label">Numero di telefono</label>
      <input
        type="number"
        min="0"
        id="phone"
        placeholder="1234567890"
        pattern="[0-9]{10}"
        class="form-control @error('telephone_number') is-invalid @enderror"
        name="telephone_number"
        id="telephone_number"
        value="{{ old('telephone_number', $restaurant->telephone_number) }}">

      @error('telephone_number')
        <span class="text-danger">{{ $message }}</span>
      @enderror

      <div id="errorNumber"></div>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Immagine</label>
      <input
        type="file"
        class="form-control"
        id="image_path"
        name="image_path"
        onchange="showImage(event)">

      <img
        id="default-image"
        width="150px"
        src="{{ asset('storage/' . $restaurant?->image_path) }}"
        alt="{{ $restaurant?->image_name }}"
        onerror="this.src='/img/noimage.jpg'"
        class="pt-2">
      <div>
        <input type="radio" name="noImage" onchange="removeImage()">
        <label for="noImage">Nessun immagine</label>
      </div>
    </div>

    <div class="accordion w-75" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Tipi di ristorante
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="form-check d-flex flex-column">
              @foreach ($types as $type)
              <div class="input-wrapper">
                <input
                  type="checkbox"
                  class="form-check-input"
                  autocomplete="off"
                  id="type{{$loop->iteration}}"
                  name="type_id[]"
                  value="{{ $type->id }}"
                  @if(!$errors->any() && $restaurant?->types->contains($type))
                    checked
                    @elseif($errors->any() && in_array($type->id, old('type_id', [])))
                    checked
                  @endif>
                <label class="form-check-label text-capitalize" for="type{{$loop->iteration}}">{{ $type->name }}</label>
              </div>
              @endforeach

              @error('type_id')
                <p class="text-danger py-1">{{ $message }}</p>
              @enderror

              <div id="errorType"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-success">{{ $button }}</button>
    </div>

  </form>
  </div>

  <script>
    ClassicEditor
      .create(document.querySelector('#text'))
      .catch(error => {
        console.error(error);
      });

    function showImage(event) {
      const tagImage = document.getElementById('default-image');
      tagImage.src = URL.createObjectURL(event.target.files[0]);
    }

    function removeImage() {
      const imageInput = document.getElementById('image_path');
      imageInput.value = '';
      const tagImage = document.getElementById('prev-image');
      tagImage.src = '';
    }

    let errors = [];
    let message;
    let condition = true;

    function convalidaForm(formData) {

      let errorsList = document.getElementById("errorsList");
      errorsList.innerHTML = '';
      errors = [];
      reset();

      //controlli di validazione

      controll(formData.name.value.length === 0, 'Il nome è un campo obbligatorio', 'errorName')
      controll(formData.name.value.length < 5 , 'Il nome deve avere almeno 5 caratteri', 'errorName')
      controll(formData.name.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
      controll(formData.email.value.length === 0, 'L\'email è un campo obbligatorio', 'errorEmail')
      controll(formData.email.value.length < 5 , 'L\'email deve avere almeno 5 caratteri', 'errorEmail')
      controll(formData.email.value.length > 255, 'L\'email può avere un massimo di 255 caratteri', 'errorEmail')
      controll(formData.address.value.length === 0, 'L\'indirizzo è un campo obbligatorio', 'errorAddress')
      controll(formData.address.value.length < 5 , 'L\'indirizzo deve avere almeno 5 caratteri', 'errorAddress')
      controll(formData.address.value.length > 255, 'L\'indirizzo può avere un massimo di 255 caratteri', 'errorAddress')
      controll(formData.piva.value === '', 'P. Iva è un campo obbligatorio', 'errorIva')
      controll(formData.piva.value > 99999999999 , 'P. Iva deve avere 11 numeri', 'errorIva')
      controll(formData.telephone_number.value === '', 'Il numero di telefono è un campo obbligatorio', 'errorNumber')
      // controll(formData.type_id.length === 0, 'Devi selezionare almeno un tipo', 'errorType')

      //stampa errori

      if (errors.length > 0) {

        let liErrors = '';
        errors.forEach((error) => {
           liErrors += `<li>${error}</li>`
        });

        errorsList.innerHTML += `
          <div class="d-flex justify-content-start">
            <div class="alert alert-danger  py-1" role="alert">
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
      document.getElementById('errorEmail').innerHTML = '';
      document.getElementById('errorAddress').innerHTML = '';
      document.getElementById('errorIva').innerHTML = '';
      document.getElementById('errorNumber').innerHTML = '';
    }
  </script>
@endsection
