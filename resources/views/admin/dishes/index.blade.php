@extends('layouts.admin')

@section('content')
  <div class="container">

    @if (session('deleted'))
      <div class="alert alert-success" role="alert">
        {{ session('deleted') }}
      </div>
    @endif

    <a class="btn btn-success mb-4" href="{{route('admin.dishes.create')}}" title="Aggiungi un piatto"><span class="me-2 d-none d-md-inline">Aggiungi un piatto</span><i class="fa-solid fa-plus"></i></a>

    <div class="table-container rounded-3 overflow-hidden py-5 bg-white border border-1">
      <table class="table table-hover m-0 w-100">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col" class="d-none d-md-table-cell">Visible</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dishes as $dish)
            <tr>
              <th scope="row">{{ $dish->id }}</th>
              <td>{{ $dish->name }}</td>
              <td class="d-none d-md-table-cell">{{ $dish->visible }}</td>
              <td>{{ $dish->price }} &euro;</td>
              <td>
                <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-primary d-none d-md-inline-block">
                  <i class="fa-solid fa-eye"></i>
                </a>
                <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning d-none d-md-inline-block">
                  <i class="fa-solid fa-pencil"></i>
                </a>
                <form
                  action="{{ route('admin.dishes.destroy', $dish) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Confirm deletion?')"
                >
                  @csrf
                  @method('DELETE')

                  <button class="btn btn-danger d-none d-md-inline-block">
                    <i class="fa-solid fa-trash"></i>
                  </button>

                </form>

                <div class="dropdown d-md-none">
                  <button class="btn btn--outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admin.dishes.show', $dish) }}">Mostra</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
