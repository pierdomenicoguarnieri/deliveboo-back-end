@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null)

  @section('content')

  @endsection

@else
  @section('content')
    <div class="container">

      <h2 class="fs-4 text-secondary my-4">
          Attenzione!
      </h2>
      <div class="row justify-content-center">
          <div class="col">
              <div class="card boo-wrapper border-0">
                  <div class="card-body">
                      @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                      @endif
                      <div>
                        <span class="d-block">Attenzione <strong>{{Auth::user()->name}}</strong>, non hai ancora aggiunto un ristorante!</span>
                        <a href="{{route('admin.restaurants.create')}}" class="btn btn-success mt-3">Aggiungi ora un ristorante!</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  @endsection
@endif
