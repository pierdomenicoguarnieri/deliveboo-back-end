@extends('layouts.admin')

@section('content')


  <div class="container py-5">
    <h1>Registra un nuovo ristorante!</h1>
    <form action="{{route('admin.restaurants.store')}}" method="POST" class="mt-5">
      @csrf

      @if($errors->any())

      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

    @endif

      <div class="mb-3">
        <label for="name" class="form-label">Restaurant Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
        @error('name')
          <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Restaurant Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
        @error('email')
          <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">Restaurant Address</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address') }}">
        @error('address')
          <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="piva" class="form-label">P. IVA</label>
        <input type="number" class="form-control @error('piva') is-invalid @enderror" name="piva" id="piva" value="{{ old('piva') }}">
        @error('piva')
          <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="telephone_number" class="form-label">Restaurant Telephone Number</label>
        <input type="text" id="phone" placeholder="1234567890" pattern="[0-9]{3}[0-9]{2}[0-9]{4}" class="form-control @error('telephone_number') is-invalid @enderror" name="telephone_number" id="telephone_number" value="{{ old('telephone_number') }}">
        @error('telephone_number')
          <span class="text-danger">{{$message}}</span>
        @enderror
r">
cess">Crea</button>
    </form>
  </div>
@endsection
