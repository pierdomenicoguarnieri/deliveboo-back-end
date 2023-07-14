@extends('layouts.admin')

@section('content')


  <div
    class="container rounded-3 bg-white border border-1 py-4 px-5">
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

  <form action="{{ $route }}" method="POST" class="mt-5" enctype="multipart/form-data">
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
    </div>

    <div class="mb-3">
      <label for="piva" class="form-label">P. IVA</label>
      <input
        type="number"
        class="form-control @error('piva') is-invalid @enderror"
        placeholder="P. Iva"
        name="piva"
        id="piva"
        value="{{ old('piva', $restaurant->piva) }}">

      @error('piva')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="telephone_number" class="form-label">Numero di telefono</label>
      <input
        type="text"
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

    <label for="check_type" class="form-label">Tipi di ristorante</label>
    <div class="btn-group-vertical d-block" role="group" aria-label="Basic checkbox toggle button group">
      @foreach ($types as $type)
        <input
          type="checkbox"
          class="btn-check"
          autocomplete="off"
          id="{{ $type->id }}"
          name="type_id[]"
          value="{{ $type->id }}"
          @if($type->id == old('type_id', $restaurant->type?->id))
            checked
          @endif>
        <label class="btn btn-outline-primary text-capitalize" for="{{ $type->id }}">{{ $type->name }}</label>
      @endforeach

      @error('type_id')
        <p class="text-danger py-1">{{ $message }}</p>
      @enderror
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
  </script>
@endsection
