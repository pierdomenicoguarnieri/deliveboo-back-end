@extends('layouts.admin')

@section('content')
  <div class="container">

    <h1 class="py-3">Lista Piatti</h1>

    @if (session('deleted'))
      <div class="alert alert-success" role="alert">
        {{ session('deleted') }}
      </div>
    @endif

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Visible</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dishes as $dish)
          <tr>
            <th scope="row">{{ $dish->id }}</th>
            <td>{{ $dish->name }}</td>
            <td>{{ $dish->visible }}</td>
            <td>{{ $dish->price }} &euro;</td>
            <td>
              <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-primary">
                <i class="fa-solid fa-binoculars"></i>
              </a>
              <a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-warning">
                <i class="fa-regular fa-pen-to-square"></i>
              </a>

              @include('admin.partials.form-delete',[
                  'title' => 'Eliminazione Piatto',
                  'id' => $dish->id,
                  'message' => "Confermi l'eliminazione del piatto: $dish->name ?",
                  'route' => route('admin.dishes.destroy', $dish)
              ])

              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
