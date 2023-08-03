@extends('layouts.admin')

@section('content')

  @if ($restaurant->dishes->contains($order->dishes[0]->id))
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="card h-75 w-100 border-0 bg-transparent m-0 text-bg-dark">

        <div class="card-img-overlay bg-white shadow rounded-5 text-dark">
          <div class="order-info overflow-y-auto h-100 d-flex flex-column">
            <div class="title-container d-flex justify-content-between align-items-center mb-4 pe-2">
              <h2 class="fs-1 m-0">Ordine N. {{ $order->id }}</h2>

              <div class="buttons-container">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                  <i class="fa-solid fa-arrow-rotate-left"></i>
                </a>
              </div>
            </div>
            <div class="infos fs-5">
              <p class="fw-bold">Nome: <span class="fw-normal">{{ $order->user_name }}</span></p>
              <p class="fw-bold">Cognome: <span class="fw-normal">{{ $order->user_lastname }}</span></p>
              <p class="fw-bold">Indirizzo: <span class="fw-normal">{{ $order->user_address }}</span></p>
              <p class="fw-bold">Numero di telefono <span class="fw-normal">{{ $order->user_telephone_number }}</span></p>
              <p class="fw-bold">Totale: <span class="fw-normal">{{ number_format($order->tot_order, 2) }} &euro;</span></p>
              <p class="fw-bold">Data dell'ordine: <span class="fw-normal">{{ $order->created_at }}</span></p>
              <p class="fw-bold">Totale: <span class="fw-normal">{{ number_format($order->tot_order, 2) }} &euro;</span></p>

              <table class="table mt-4">
                <thead>
                  <tr>
                    <th scope="col" class="d-none d-sm-table-cell">Id. Piatto</th>
                    <th scope="col">Piatto</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Tot.</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order->dishes as $key => $dish)
                    <tr>
                      <th scope="row" class="d-none d-sm-table-cell">{{ $dish->id }}</th>
                      <td>{{ $dish->name }}</td>

                      <td>{{ $order_pivot[$key]->quantity }}</td>

                      <td>{{ $dish->price }} &euro;</td>
                    </tr>
                  @endforeach
                  <tr>
                    <th class="d-none d-sm-table-cell"></th>
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
    </div>
  @else
    <div class="contanier boo-wrapper h-auto">
      <h2>Autorizzazione negata!</h2>
    </div>
  @endif
@endsection
