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
        <div class="card-img-overlay bg-dark bg-opacity-50 rounded-5">
          <div class="dish-info overflow-y-auto h-100 d-flex flex-column">
            <h2 class="text-center fs-1 mb-4">{{ $dish->name }}</h2>
            <div class="infos fs-4">
              <p class="fw-bold">Prezzo: <span class="fw-normal">{{ $dish->price }} &euro;</span></è>
              <p class="fw-bold mb-3">Visibile: <i class="fa-solid {{ $dish->visible ? 'fa-check' : 'fa-x' }}"></i></p>
              <div class="description-wrapper d-flex flex-wrap">
                <span class="me-2 fw-bold">Descrizione:</span>
                {!! $dish->description !!}
              </div>
              <div class="ingredients-wrapper mb-3 d-flex flex-wrap">
                <span class="me-2 fw-bold">ingredienti:</span>
                <span class="fw-normal">{{ $dish->ingredients }}</span>
              </div>
              <p class="{{$dish->is_vegan || $dish->is_frozen || $dish->is_gluten_free || $dish->is_lactose_free ? '' : 'd-none' }}" class="fw-bold">Tipo: <span class="fw-normal">{{ $dish->type }}</span></p>
              <div class="dish-flags d-flex mb-4">
                <span class="btn btn-outline-primary boo-btn me-2 {{ $dish->is_vegan ? 'active' : 'd-none' }}">
                  <i class="fa-solid fa-seedling"></i>
                  <span class="d-none d-xl-inline">Vegano</span>
                </span>
                <span class="btn btn-outline-primary boo-btn me-2 {{ $dish->is_frozen ? 'active' : 'd-none' }}"><i class="fa-solid fa-snowflake"></i> <span class="d-none d-xl-inline">Surgelato</span></span>
                <span class="btn btn-outline-primary boo-btn me-2 {{ $dish->is_gluten_free ? 'active' : 'd-none' }}"><i class="fa-solid fa-wheat-awn-circle-exclamation"></i> <span class="d-none d-xl-inline">Senza glutine</span></span>
                <span class="btn btn-outline-primary boo-btn me-2 {{ $dish->is_lactose_free ? 'active' : 'd-none' }}"><i class="fa-solid fa-cow"></i> <span class="d-none d-xl-inline">Senza Lattosio</span></span>
              </div>
            </div>

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
