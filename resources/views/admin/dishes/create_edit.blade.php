@extends('layouts.admin')

@section('content')
  <div class="container rounded-3 bg-white border border-1 py-4 px-5">

    <form
      action="{{ $route }}"
      method="POST"
      enctype="multipart/form-data"
    >
      @csrf
      @method($method)

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          name="name"
          value="{{ old('name', $dish?->name) }}"
          placeholder="Insert name"
        >
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input
          type="number"
          class="form-control"
          id="price"
          name="price"
          step="0.01"
          value="{{ old('price', $dish?->price) }}"
          placeholder="Insert price"
        >
      </div>


      <div class="form-check form-switch mb-3">
        <input
          class="form-check-input"
          type="checkbox"
          role="switch"
          id="flexSwitchCheckChecked"
          name="visible"
          id="visible"
          value="{{ old('visible') }}"
          @if($dish?->visible)
          checked
          @endif>
        <label for="price" class="price">Visibile</label>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
          class="form-control"
          id="description"
          name="description"
          rows="3"
        >
          {{ old('description', $dish?->description) }}
        </textarea>
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <input
          type="text"
          class="form-control"
          id="ingredients"
          name="ingredients"
          value="{{ old('ingredients', $dish?->ingredients) }}"
          placeholder="Insert ingredients"
        >
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input
          type="text"
          class="form-control"
          id="type"
          name="type"
          value="{{ old('type', $dish?->type) }}"
          placeholder="Insert type"
        >
      </div>

      <div class="btn-group-vertical" role="group" aria-label="Basic checkbox toggle button group">
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
        <label class="btn btn-outline-primary" for="is_vegan">Vegan</label>

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
        <label class="btn btn-outline-primary" for="is_frozen">Frozen</label>

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
        <label class="btn btn-outline-primary" for="is_gluten_free">Gluten Free</label>

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
        <label class="btn btn-outline-primary" for="is_lactose_free">Lactose Free</label>
      </div>

      <button class="btn btn-primary d-block mt-3" type="submit">Submit</button>

    </form>
  </div>
@endsection
