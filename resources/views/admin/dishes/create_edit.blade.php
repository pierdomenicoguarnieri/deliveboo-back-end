@extends('layouts.admin')

@section('content')
@if ($dish?->restaurant_id === Auth::user()->restaurant_id || str_contains(Route::currentRouteName(), 'admin.dishes.create'))
  <div class="container boo-wrapper">
      <h1 class="py-3">{{ $title }}</h1>

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
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
        enctype="multipart/form-data"
        onsubmit="return convalidaForm(this)">
        @csrf
        @method($method)

        <div class="mb-3">
          <label for="name" class="form-label">Nome</label>
          <input type="text"
            class="form-control @error('name') is-invalid @endif"
            id="name"
            name="name"
            value="{{ old('name', $dish?->name) }}"
            placeholder="Inserisci il nome">

            @error('name')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div id="errorName"></div>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Prezzo</label>
          <input type="number"
            class="form-control @error('price') is-invalid @endif"
            id="price"
            name="price"
            step="0.01"
            value="{{ old('price', $dish?->price) }}"
            placeholder="Inserisci il prezzo del piatto">

          @error('price')
            <div class="alert alert-danger" role="alert">{{ $message }}</div>
          @enderror

          <div id="errorPrice"></div>
        </div>


      <div class="form-check form-switch mb-3">
        <input
          class="form-check-input"
          type="checkbox"
          role="switch"
          name="visible"
          id="visible"
          value="1"
          @if(old('visible',$dish?->visible))
            checked
          @endif>
        <label for="visible" class="visible">Visibile</label>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Immagine</label>
        <input
          class="form-control mb-3"
          onchange="showImage(event)"
          id="image"
          name='image'
          type="file">

          <img
            id="prev-image"
            name="prev-image"
            width="150px"
            src="{{ old('prev-image', asset('storage/' . $dish?->image_path)) }}"
            onerror="this.src='/img/noimage.jpg'">

          <div>
            <input type="radio" name="noImage" onchange="removeImage()">
            <label for="noImage">Nessuna immagine</label>
          </div>
        </div>

        <div class="mb-3">
          <label for="ingredients" class="form-label">Ingredienti</label>
          <input
            type="text"
            class="form-control @error('ingredients') is-invalid @endif"
            id="ingredients"
            name="ingredients"
            value="{{ old('ingredients', $dish?->ingredients) }}"
            placeholder="Inseriscri ingredienti">

          @error('ingredients')
            <div class="alert alert-danger" role="alert">{{ $message }} </div>
          @enderror

          <div id="errorIngredients"></div>
        </div>

      <div class="mb-3">
        <label for="type" class="form-label">Tipo</label>
        <input
          type="text"
          class="form-control @error('type') is-invalid @endif"
          id="type"
          name="type"
          value="{{ old('type', $dish?->type) }}"
          placeholder="Inserisci tipo">

        @error('type')
          <div class="alert alert-danger" role="alert">{{ $message }}</div>
        @enderror

        <div id="errorType"></div>
      </div>

      <label for="allergens" class="d-block mb-2">Allergeni</label>
      <div class="btn-group-horizontal" role="group"  id="allergens">
        <input
        type="checkbox"
        class="btn-check"
        id="is_vegan"
        autocomplete="off"
        name="is_vegan"
        value="1"
        @if (old('is_vegan',$dish?->is_vegan)) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_vegan"><i class="fa-solid fa-seedling"></i> <span class="d-none d-xl-inline">Vegano</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_frozen"
        autocomplete="off"
        name="is_frozen"
        value="1"
        @if (old('is_frozen',$dish?->is_frozen)) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_frozen"><i class="fa-solid fa-snowflake"></i> <span class="d-none d-xl-inline">Surgelato</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_gluten_free"
        autocomplete="off"
        name="is_gluten_free"
        value="1"
        @if (old('is_gluten_free',$dish?->is_gluten_free)) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_gluten_free"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i> <span class="d-none d-xl-inline">Senza glutine</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_lactose_free"
        autocomplete="off"
        name="is_lactose_free"
        value="1"
        @if (old('is_lactose_free', $dish?->is_lactose_free)) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_lactose_free"><i class="fa-solid fa-cow"></i> <span class="d-none d-xl-inline">Senza Lattosio</span></label>
      </div>

        <button class="btn btn-success d-block mt-4" type="submit">Invia</button>
      </form>
    @else
      <div class="contanier boo-wrapper h-auto">
        <h2>Autorizzazione negata!</h2>
      </div>
    @endif
  </div>

  <script>
    ClassicEditor
      .create(document.querySelector('#description'))
      .catch(error => {
        console.error(error);
      });

    function showImage(event) {
      const tagImage = document.getElementById('prev-image');
      tagImage.src = URL.createObjectURL(event.target.files[0]);
    }

    function removeImage() {
      const imageInput = document.getElementById('image');
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
      controll(formData.name.value.length > 255, 'Il nome può avere un massimo di 255 caratteri', 'errorName')
      controll(formData.price.value.length === 0, 'Il prezzo è un campo obbligatorio', 'errorPrice')
      controll(formData.price.value > 999.99, 'Il prezzo non può superare i 999.99 €', 'errorPrice')
      controll(formData.ingredients.value.length < 20 , 'Gli ingredienti devono avere almeno 5 caratteri', 'errorIngredients')
      controll(formData.ingredients.value.length > 1000, 'Gli ingredienti possono avere un massimo di 1000 caratteri', 'errorIngredients')
      controll(formData.type.value > 50 , 'Il tipo può avere al massimo 50 caratteri', 'errorType')

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
      window.scrollTo(0, 0);

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
      document.getElementById('errorPrice').innerHTML = '';
      document.getElementById('errorIngredients').innerHTML = '';
      document.getElementById('errorType').innerHTML = '';
    }
  </script>
@endsection
