@extends('layouts.admin')

@section('content')
  <div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="card h-75 w-100 border-0 bg-transparent m-0 text-bg-dark">

      <div class="card-img-overlay bg-dark bg-opacity-25 rounded-5">
        <div class="dish-info overflow-y-auto h-100 d-flex flex-column">
        <h2>Ordine N. {{ $order->id }}</h2>
          <p>Nome: <strong class="text-black">{{ $order->user_name }}</strong></p>
          <p>Cognome: <strong class="text-black">{{ $order->user_lastname }}</strong></p>
          <p>Indirizzo: <strong class="text-black">{{ $order->user_address }}</strong></p>
          <p>Numero di telefono <strong class="text-black">{{ $order->user_telephone_number }}</strong></p>
          <p>Email: <strong class="text-black">{{ $order->user_email }}</strong></p>
          <p>Prezzo Tot.: <strong class="text-black">{{ $order->tot_order }} &euro;</strong></p>

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

          <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">Id. Piatto</th>
                <th scope="col">Piatto</th>
                <th scope="col">Quantità</th>
                <th scope="col">Tot. ordine</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->dishes as $dish)
                <tr>
                  <th scope="row">{{ $dish->id }}</th>
                  <td>{{ $dish->name }}</td>
                  <td>quantità</td>
                  <td>{{ $dish->price }} &euro;</td>
                </tr>
              @endforeach
              <tr>
                <th></th>
                <td></td>
                <td></td>
                <td>{{ $order->tot_order }} &euro;</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
