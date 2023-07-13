@extends('layouts.admin')

@section('content')
  <div class="container">
    <form
      action="{{ route('admin.dishes.store') }}"
      method="POST"
      enctype="multipart/form-data"
    >
    @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          name="name"
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
          placeholder="Insert price"
        >
      </div>

      <div class="mb-3">
        <label for="visible" class="form-label">Visible</label>
        <input
          type="text"
          class="form-control"
          id="visible"
          name="visible"
          placeholder="Visible"
        >
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
          class="form-control"
          id="description"
          name="description"
          rows="3"
        ></textarea>
      </div>

      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <input
          type="text"
          class="form-control"
          id="ingredients"
          name="ingredients"
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
          placeholder="Insert type"
        >
      </div>

      <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        <input type="checkbox" class="btn-check" id="is_vegan" autocomplete="off" name="is_vegan">
        <label class="btn btn-outline-primary" for="is_vegan">Vegan</label>
      
        <input type="checkbox" class="btn-check" id="is_frozen" autocomplete="off" name="is_frozen">
        <label class="btn btn-outline-primary" for="is_frozen">Frozen</label>
      
        <input type="checkbox" class="btn-check" id="is_gluten_free" autocomplete="off" name="is_gluten_free">
        <label class="btn btn-outline-primary" for="is_gluten_free">Gluten Free</label>
      
        <input type="checkbox" class="btn-check" id="is_lactose_free" autocomplete="off" name="is_lactose_free">
        <label class="btn btn-outline-primary" for="is_lactose_free">Lactose Free</label>
      </div>

      <button class="btn btn-primary">Submit</button>

    </form>
  </div>
@endsection