@extends('layouts.admin')

@section('content')
  <div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="card h-75 w-100 border-0 bg-transparent m-0 text-bg-dark">

      <div class="card-img-overlay bg-dark bg-opacity-25 rounded-5">
        <div class="dish-info overflow-y-auto h-100 d-flex flex-column">
        <h2>Ordine N. {{ $order->id }}</h2>
          <p>Nome: {{ $order->user_name }}</p>
          <p>Cognome: {{ $order->user_lastname }}</p>
          <p>Indirizzo: {{ $order->user_address }}</p>
          <p>Numero di telefono: {{ $order->user_telephone_number }}</p>
          <p>Email: {{ $order->user_email }}</p>
          <p>Prezzo Tot.: {{ $order->tot_order }}</p>

          <div class="buttons-container">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
              <i class="fa-solid fa-arrow-rotate-left"></i>
            </a>

            @include('admin.partials.form-delete',[
              'title' => 'Eliminazione Ordine',
              'id' => $order->id,
              'message' => "Confermi l'eliminazione dell'ordine con id: $order->id ?",
              'route' => route('admin.orders.destroy', $order)
              ])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
