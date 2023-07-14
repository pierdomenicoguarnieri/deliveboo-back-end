@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>{{ $dish->name }}</h2>
    <img
      src="{{ asset('storage/' . $dish->image_path) }}"
      alt="{{ $dish->image_name }}"
      onerror="this.src='/img/noimage.jpg'"
    >
    <span>Prezzo: {{ $dish->price }}</span>
    <span>Visibile: {{ $dish->visible ? 'Si' : 'No' }}</span>
    <p>Descrizione: {{ $dish->description }}</p>
    <p>Ingredienti: {{ $dish->ingredients }}</p>
    <span>Vegano: {{ $dish->is_vegan ? 'Si' : 'No' }}</span>
    <span>Surgelato: {{ $dish->is_frozen ? 'Si' : 'No' }}</span>
    <span>Senza glutine: {{ $dish->is_gluten_free ? 'Si' : 'No' }}</span>
    <span>Senza lattosio: {{ $dish->is_lactose_free ? 'Si' : 'No' }}</span>
    <span>Tipo: {{ $dish->type }}</span>

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
