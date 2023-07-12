@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null)

  @section('content')
  <div class="container">
      <h2 class="fs-4 text-secondary my-4">
          {{ __('Dashboard') }}
      </h2>
      <div class="row justify-content-center">
          <div class="col">
              <div class="card">
                  <div class="card-header">{{ __('User Dashboard') }}</div>

                  <div class="card-body">
                      @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                      @endif

                      {{ __('You are logged in!') }}
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endsection

@else
  @section('content')
    <div class="container">
      <h2 class="fs-4 text-secondary my-4">
          Attenzione!
      </h2>
      <div class="row justify-content-center">
          <div class="col">
              <div class="card">
                  <div class="card-header">Attenzione <span class="fw-bold">{{Auth::user()->name}}</span>, Non hai ancora aggiunto un ristorante!</div>

                  <div class="card-body">
                      @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                      @endif
                      Sei loggato con successo, però sembra che tu non abbia ancora aggiunto un ristorante!

                      <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary">Aggiungi ora un ristorante!</a>
                  </div>
              </div>
          </div>
      </div>
    </div>
  @endsection
@endif
