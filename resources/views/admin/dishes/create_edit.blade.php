@extends('layouts.admin')

@section('content')
  <div class="container">

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form
      action="{{ $route }}"
      method="POST"
      enctype="multipart/form-data"
    >
      @csrf
      @method($method)

      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input
          type="text"
          class="form-control @error('name') is-invalid @endif"
          id="name"
          name="name"
          value="{{ old('name', $dish?->name) }}"
          placeholder="Inserisci il nome"
        >
        @error('name')
          <div class="alert alert-danger" role="alert">
	          {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Prezzo</label>
        <input
          type="number"
          class="form-control @error('price') is-invalid @endif"
          id="price"
          name="price"
          value="{{ old('price', $dish?->price) }}"
          placeholder="Inserisci il prezzo del piatto"
        >
        @error('price')
          <div class="alert alert-danger" role="alert">
	          {{ $message }}
          </div>
        @enderror
      </div>

      <input
        type="checkbox" class="btn-check" id="visible" autocomplete="off" name="visible"
        value="{{ old('visible') }}"
        @if ($dish?->visible)
          checked
        @endif
      >
      <label class="btn btn-outline-primary" for="visible">Visibile</label>

      <div class="mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea
          class="form-control @error('description') is-invalid @endif"
          id="description"
          name="description"
          rows="3"
        >
          {{ old('description', $dish?->description) }}
        </textarea>
        @error('description')
          <div class="alert alert-danger" role="alert">
	          {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredienti</label>
        <input
          type="text"
          class="form-control @error('ingredients') is-invalid @endif"
          id="ingredients"
          name="ingredients"
          value="{{ old('ingredients', $dish?->ingredients) }}"
          placeholder="Inseriscri ingredienti"
        >
        @error('ingredients')
          <div class="alert alert-danger" role="alert">
	          {{ $message }}
          </div>
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
          placeholder="Inserisci tipo"
        >
        @error('type')
          <div class="alert alert-danger" role="alert">
	          {{ $message }}
          </div>
        @enderror
      </div>

      <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input
          type="checkbox"
          class="btn-check"
          id="is_vegan"
          autocomplete="off"
          name="is_vegan"
          value="{{ old('is_vegan') }}"
          @if ($dish?->is_vegan)
            checked
          @endif
        >
        <label class="btn btn-outline-primary" for="is_vegan">Vegano</label>

        <input
          type="checkbox"
          class="btn-check"
          id="is_frozen"
          autocomplete="off"
          name="is_frozen"
          value="{{ old('is_frozen') }}"
          @if ($dish?->is_frozen)
            checked
          @endif
        >
        <label class="btn btn-outline-primary" for="is_frozen">Surgelato</label>

        <input
          type="checkbox"
          class="btn-check"
          id="is_gluten_free"
          autocomplete="off"
          name="is_gluten_free"
          value="{{ old('is_gluten_free') }}"
          @if ($dish?->is_gluten_free)
            checked
          @endif
        >
        <label class="btn btn-outline-primary" for="is_gluten_free">Senza glutine</label>

        <input
          type="checkbox"
          class="btn-check"
          id="is_lactose_free"
          autocomplete="off"
          name="is_lactose_free"
          value="{{ old('is_lactose_free') }}"
          @if ($dish?->is_lactose_free)
            checked
          @endif
        >
        <label class="btn btn-outline-primary" for="is_lactose_free">Senza lattosio</label>
      </div>

      <button class="btn btn-primary" type="submit">Invia</button>

    </form>
  </div>
@endsection
