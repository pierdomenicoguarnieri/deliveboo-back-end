@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>{{ $dish->name }}</h2>
    <span>Price: {{ $dish->price }}</span>
    <span>Visible: {{ $dish->visible ? 'Si' : 'No' }}</span>
    <p>Description: {{ $dish->description }}</p>
    <p>Ingredients: {{ $dish->ingredients }}</p>
    <span>Is Vegan: {{ $dish->is_vegan ? 'Si' : 'No' }}</span>
    <span>Is Frozen: {{ $dish->is_frozen ? 'Si' : 'No' }}</span>
    <span>Is Gluten Free: {{ $dish->is_gluten_free ? 'Si' : 'No' }}</span>
    <span>Is Lactose Free: {{ $dish->is_lactose_free ? 'Si' : 'No' }}</span>
    <span>Type: {{ $dish->type }}</span>
    <a
      href="{{ route('admin.dishes.index') }}"
      class="btn btn-primary"
    >
      <i class="fa-solid fa-arrow-rotate-left"></i>
    </a>
  </div>
@endsection