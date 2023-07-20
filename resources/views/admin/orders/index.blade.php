@extends('layouts.admin')

@section('content')
  <div class="container boo-wrapper">
    <div class="w-100 d-lg-flex align-items-center justify-content-between">
      <h1 class="py-3">Lista Ordini</h1>
    </div>


    @if (session('deleted'))
      <div class="alert alert-success" role="alert">
        {{ session('deleted') }}
      </div>
    @endif

    <div class="table-container rounded-3 py-5 bg-white border border-1">

      @if ($orders != null)

        <table class="table table-hover m-0 w-100">
          <thead>
            <tr>
              <th scope="col">Id. Ordine</th>
              <th scope="col">Nome</th>
              <th scope="col">Cognome</th>
              <th scope="col" class="d-none d-md-table-cell">Tel.</th>
              <th scope="col">Totale</th>
              <th scope="col">Info</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $order)
              <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->user_name }}</td>
                <td>{{ $order->user_lastname }}</td>
                <td>{{ $order->user_telephone_number }}</td>
                <td>{{ $order->tot_order }} &euro;</td>
                <td>
                  <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary d-none d-lg-inline-block">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  <div class="dropdown d-lg-none">
                    <button class="btn btn--outline-secondary position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.orders.show', $order) }}">Mostra</a></li>

                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      @else
      <div class="py-3 text-center">
        <h3>Non sono presenti ordini!!</h3>
      </div>
      @endif
    </div>
  </div>
@endsection
