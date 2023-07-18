@extends('layouts.admin')

@section('content')
@if ($dish->restaurant_id === Auth::user()->restaurant_id)
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

      <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
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
        </div>


      <div class="form-check form-switch mb-3">
        <input
          class="form-check-input"
          type="checkbox"
          role="switch"
          name="visible"
          id="visible"
          value="{{ old('visible') }}"
          @if($dish?->visible)
            checked
          @endif>
        <label for="visible" class="visible">Visibile</label>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea
          class="form-control @error('description') is-invalid @endif"
          id="description"
          name="description">
          {{ old('description', $dish?->description) }}
        </textarea>

        @error('description')
          <div class="alert alert-danger" role="alert">{{ $message }}</div>
        @enderror
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
      </div>

      <label for="allergens" class="d-block mb-2">Allergeni</label>
      <div class="btn-group-horizontal" role="group"  id="allergens">
        <input
        type="checkbox"
        class="btn-check"
        id="is_vegan"
        autocomplete="off"
        name="is_vegan"
        value="{{ old('is_vegan') }}"
        @if ($dish?->is_vegan) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_vegan"><i class="fa-solid fa-seedling"></i> <span class="d-none d-xl-inline">Vegano</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_frozen"
        autocomplete="off"
        name="is_frozen"
        value="{{ old('is_frozen') }}"
        @if ($dish?->is_frozen) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_frozen"><i class="fa-solid fa-snowflake"></i> <span class="d-none d-xl-inline">Surgelato</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_gluten_free"
        autocomplete="off"
        name="is_gluten_free"
        value="{{ old('is_gluten_free') }}"
        @if ($dish?->is_gluten_free) checked @endif>
        <label class="btn btn-outline-primary boo-btn" for="is_gluten_free"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i> <span class="d-none d-xl-inline">Senza glutine</span></label>

        <input
        type="checkbox"
        class="btn-check"
        id="is_lactose_free"
        autocomplete="off"
        name="is_lactose_free"
        value="{{ old('is_lactose_free') }}"
        @if ($dish?->is_lactose_free) checked @endif>
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
  </script>
@endsection
