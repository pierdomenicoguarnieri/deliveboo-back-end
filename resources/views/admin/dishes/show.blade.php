@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>{{ $dish->name }}</h2>
    <img
      src="{{ asset('storage/' . $dish->image_path) }}"
      alt="{{ $dish->image_name }}"
      onerror="this.src='/img/noimage.jpg'"
    >
    <span>Price: {{ $dish->price }}</span>
    <span>Visible: {{ $dish->visible ? 'Si' : 'No' }}</span>
    <p>Description: {{ $dish->description }}</p>
    <p>Ingredients: {{ $dish->ingredients }}</p>
    <span>Vegan: {{ $dish->is_vegan ? 'Si' : 'No' }}</span>
    <span>Frozen: {{ $dish->is_frozen ? 'Si' : 'No' }}</span>
    <span>Gluten Free: {{ $dish->is_gluten_free ? 'Si' : 'No' }}</span>
    <span>Lactose Free: {{ $dish->is_lactose_free ? 'Si' : 'No' }}</span>
    <span>Type: {{ $dish->type }}</span>

    <a
      href="{{ route('admin.dishes.index') }}"
      class="btn btn-primary"
    >
      <i class="fa-solid fa-arrow-rotate-left"></i>
    </a>
    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning">
      <i class="fa-regular fa-pen-to-square"></i>
    </a>
    <form
      action="{{ route('admin.dishes.destroy', $dish) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('Confirm deletion?')"
    >
      @csrf
      @method('DELETE')

      <button class="btn btn-danger">
        <i class="fa-solid fa-trash"></i>
      </button>
    </form>
  </div>
@endsection
