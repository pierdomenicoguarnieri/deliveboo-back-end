@extends('layouts.admin')

@section('content')
  <div class="container boo-wrapper">
    <div class="w-100 d-lg-flex align-items-center justify-content-between">
      <h1 class="py-3">Lista Piatti Eliminati</h1>

      @if ($dishes_del[0] != null)
        <div class="pb-2">
          <form
            class="d-flex me-5 search_dishes"
            method="GET"
          >
            <input
            @if (isset($_GET['search']))
              value="{{$_GET['search']}}"
            @else
              value=""
            @endif
            type="text" name="search" placeholder="Cerca piatto eliminato">
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

    <div class="table-container rounded-3 py-5 bg-white border border-1">
      @if ($dishes_del[0] != null)
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
            @foreach ($dishes_del as $dish)
              <tr>
                <th scope="row">{{ $dish->id }}</th>
                <td>{{ $dish->name }}</td>
                <td class="d-none d-md-table-cell">{{ $dish->visible ? 'Si' : 'No' }}</td>
                <td>{{ $dish->price }} &euro;</td>
                <td>
                  <div class="d-none d-lg-inline-block">
                    @include('admin.partials.form-delete-restore',[
                      'title' => 'Ripristina Piatto',
                      'id' => $dish->id,
                      'message' => "Confermi il ripristino del piatto: $dish->name ?",
                      'route' => route('admin.restore.dish', $dish),
                      'mobile' => false,
                      'method' => 'POST',
                      'text' => 'Ripristina',
                      'icon' => 'fa-solid fa-trash-can-arrow-up',
                      'color_btn' => 'btn-primary'
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
    <div>
      {{ $dishes_del->links() }}
    </div>
  </div>
@endsection
