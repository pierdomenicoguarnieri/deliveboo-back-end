@extends('layouts.admin')

@section('content')
  <div class="container boo-wrapper">
    <div class="w-100 d-lg-flex align-items-center justify-content-between">

      <h1 class="py-3">Lista Piatti</h1>
      @if ($dishes[0] != null)
        <div class="pb-2">
          <form
            action="{{route('admin.dishes.index')}}"
            class="d-flex me-5 search_dishes"
            method="GET"
          >
            <input
            @if (isset($_GET['search']))
              value="{{$_GET['search']}}"
            @else
              value=""
            @endif
            type="text" name="search" placeholder="Cerca piatto">
            <button class="p-1"><i class="fa-solid fa-magnifying-glass ps-2"></i></button>
          </form>
        </div>

      @endif
    </div>


    @if (session('deleted'))
      <div class="alert alert-success" role="alert">
        {{ session('deleted') }}
      </div>
    @endif

    <a class="btn btn-success mb-4" href="{{route('admin.dishes.create')}}" title="Aggiungi un piatto"><span class="me-2 d-none d-md-inline">Aggiungi un piatto</span><i class="fa-solid fa-plus"></i></a>

    <div class="table-container rounded-3 py-5 bg-white border border-1">
      @if ($dishes[0] != null)
        <table class="table table-hover m-0 w-100">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nome</th>
              <th scope="col" class="d-none d-md-table-cell">Visible</th>
              <th scope="col">Prezzo</th>
              <th scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dishes as $dish)
              <tr>
                <th scope="row">{{ $dish->id }}</th>
                <td>{{ $dish->name }}</td>
                <td class="d-none d-md-table-cell">{{ $dish->visible ? 'Si' : 'No' }}</td>
                <td>{{ $dish->price }} &euro;</td>
                <td>
                  <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-primary d-none d-lg-inline-block">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning d-none d-lg-inline-block">
                    <i class="fa-solid fa-pencil"></i>
                  </a>
                  <div class="d-none d-lg-inline-block">
                    @include('admin.partials.form-delete-restore',[
                      'title' => 'Eliminazione Piatto',
                      'id' => $dish->id,
                      'message' => "Confermi l'eliminazione del tuo piatto: $dish->name ?",
                      'route' => route('admin.dishes.destroy', $dish),
                      'mobile' => false,
                      'method' => 'DELETE',
                      'text' => 'Elimina',
                      'icon' => 'fa-solid fa-trash-can',
                      'color_btn' => 'btn-danger'
                    ])
                  </div>

                  <div class="dropdown d-lg-none">
                    <button class="btn btn--outline-secondary position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('admin.dishes.show', $dish) }}">Mostra</a></li>
                      <li><a class="dropdown-item" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="text-center">
          <h3>Non ci sono piatti nella lista!</h3>
        </div>
      @endif
    </div>
    <div class="mt-3">
      {{ $dishes->links() }}
    </div>
  </div>
@endsection
