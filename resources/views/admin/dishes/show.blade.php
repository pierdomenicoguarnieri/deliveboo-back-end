@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>{{ $dish->name }}</h2>
    <span>Price: {{ $dish->price }}</span>
    <span>Visible: {{ $dish->visible ? 'Yes' : 'No' }}</span>
    <p>Description: {{ $dish->description }}</p>
    <p>Ingredients: {{ $dish->ingredients }}</p>
    <span>Vegan: {{ $dish->is_vegan ? 'Yes' : 'No' }}</span>
    <span>Frozen: {{ $dish->is_frozen ? 'Yes' : 'No' }}</span>
    <span>Gluten Free: {{ $dish->is_gluten_free ? 'Yes' : 'No' }}</span>
    <span>Lactose Free: {{ $dish->is_lactose_free ? 'Yes' : 'No' }}</span>
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

    @include('admin.partials.form-delete',[
        'title' => 'Eliminazione Piatto',
        'id' => $dish->id,
        'message' => "Confermi l'eliminazione del piatto: $dish->name ?",
        'route' => route('admin.dishes.destroy', $dish)
    ])
  </div>
@endsection
