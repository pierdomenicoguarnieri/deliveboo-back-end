@extends('layouts.admin')

@section('content')


  <div class="container">
    <form action="{{route('admin.restaurants.store')}}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Restaurant Email</label>
        <input type="email" class="form-control" name="email" id="email">
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Restaurant Address</label>
        <input type="text" class="form-control" name="address" id="address">
      </div>

      <div class="mb-3">
        <label for="piva" class="form-label">P. IVA</label>
        <input type="number" class="form-control" name="piva" id="piva">
      </div>

      <div class="mb-3">
        <label for="telephone_number" class="form-label">Restaurant Telephone Number</label>
        <input type="text" id="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" name="telephone_number" id="telephone_number">
      </div>

      <button type="submit" class="btn btn-success">Crea</button>
    </form>
  </div>
@endsection
