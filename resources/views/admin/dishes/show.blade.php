@extends('layouts.admin')

@section('content')
  <div class="container rounded-3 bg-white border border-1 py-4">
    <div class="content-wrapper bg-white w-100">
    <h2>{{ $dish->name }}</h2>
    <img
      src="{{ asset('storage/' . $dish->image_path) }}"
      alt="{{ $dish->image_name }}"
      onerror="this.src='/img/noimage.jpg'"
    >
    <div class="dish-info d-flex flex-column">
      <p>Prezzo: {{ $dish->price }}</p>
      <p>Visibile: {{ $dish->visible ? 'Si' : 'No' }}</p>
      <p>Descrizione: {{ $dish->description }}</p>
      <p>Ingredienti: {{ $dish->ingredients }}</p>
      <p>Vegano: {{ $dish->is_vegan ? 'Si' : 'No' }}</p>
      <p>Surgelato: {{ $dish->is_frozen ? 'Si' : 'No' }}</p>
      <p>Senza glutine: {{ $dish->is_gluten_free ? 'Si' : 'No' }}</p>
      <p>Senza lattosio: {{ $dish->is_lactose_free ? 'Si' : 'No' }}</p>
      <p>Tipo: {{ $dish->type }}</p>
    </div>

    <a
      href="{{ route('admin.dishes.index') }}"
      class="btn btn-primary"
    >
      <i class="fa-solid fa-arrow-rotate-left"></i>
    </a>
    <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning">
      <i class="fa-solid fa-pencil"></i>
    </a>

    @include('admin.partials.form-delete',[
        'title' => 'Eliminazione Piatto',
        'id' => $dish->id,
        'message' => "Confermi l'eliminazione del piatto: $dish->name ?",
        'route' => route('admin.dishes.destroy', $dish)
    ])
    </div>
  </div>
@endsection
