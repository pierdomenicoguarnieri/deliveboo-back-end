@extends('layouts.admin')

@section('content')
  <div class="container h-100 d-flex align-items-center justify-content-center">
    @if ($dish->restaurant_id === Auth::user()->restaurant_id)
      <div class="card h-75 w-100 border-0 bg-transparent m-0 text-bg-dark">
        <img
        src="{{ asset('storage/' . $dish->image_path) }}"
        alt="{{ $dish->image_name }}"
        onerror="this.src='/img/noimage.jpg'"
        class="img-fluid h-100 object-fit-cover rounded-5 shadow-sm overflow-hidden card-img">
        <div class="card-img-overlay bg-dark bg-opacity-25 rounded-5">
          <div class="dish-info overflow-y-auto h-100 d-flex flex-column">
          <h2>{{ $dish->name }}</h2>
            <p>Prezzo: {{ $dish->price }} &euro;</p>
            <p>Visibile: {{ $dish->visible ? 'Si' : 'No' }}</p>
            <p>Descrizione: {!! $dish->description !!}</p>
            <p>Ingredienti: {{ $dish->ingredients }}</p>
            <p>Vegano: {{ $dish->is_vegan ? 'Si' : 'No' }}</p>
            <p>Surgelato: {{ $dish->is_frozen ? 'Si' : 'No' }}</p>
            <p>Senza glutine: {{ $dish->is_gluten_free ? 'Si' : 'No' }}</p>
            <p>Senza lattosio: {{ $dish->is_lactose_free ? 'Si' : 'No' }}</p>
            <p>Tipo: {{ $dish->type }}</p>

            <div class="buttons-container">
              <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-rotate-left"></i>
              </a>
              <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning">
                <i class="fa-solid fa-pencil"></i>
              </a>

              @include('admin.partials.form-delete-restore',[
                'title' => 'Eliminazione Piatto',
                'id' => $dish->id,
                'message' => "Confermi l'eliminazione del piatto: $dish->name ?",
                'route' => route('admin.dishes.destroy', $dish),
                'method' => 'DELETE',
                'text' => 'Elimina',
                'icon' => 'fa-solid fa-trash-can',
                'color_btn' => 'btn-danger'
                ])
            </div>
          </div>
        </div>
      </div>
    @else
    <div class="contanier boo-wrapper h-auto">
      <h2>Autorizzazione negata!</h2>
    </div>
    @endif
  </div>
@endsection
