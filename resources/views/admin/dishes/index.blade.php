@extends('layouts.admin')

@section('content')
  <div class="container">
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
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection