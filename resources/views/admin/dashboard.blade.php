@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null)

  @section('content')

  @endsection

@else
  @section('content')
    <div class="container">

      @if (session('deleted'))
        <div class="alert alert-success" role="alert">
          {{ session('deleted') }}
        </div>
      @endif

      <h2 class="fs-4 text-secondary my-4">
          Attenzione!
      </h2>
      <div class="row justify-content-center">
          <div class="col">
              <div class="card">
                  <div class="w-100 p-2">Attenzione <strong>{{Auth::user()->name}}</strong>, non hai ancora aggiunto un ristorante!</div>

                  <div class="card-body">
                      @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                      @endif
                      <span class="py-3">Sei loggato con successo, però sembra che tu non abbia ancora aggiunto un ristorante!</span>
                      <div>
                        <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary">Aggiungi ora un ristorante!</a>
                      </div>


                  </div>
              </div>
          </div>
      </div>
    </div>
  @endsection
@endif
