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
  </div>
@endsection
