@extends('layouts.admin')

@section('content')


  <div class="container p-5">
    <h2 class="text-secondary mb-4"><strong>Ristorante: </strong>{{$restaurant->name}}</h2>

    <div>
      <p><strong>Email: </strong>{{$restaurant->email}}</p>

      <p><strong>Numero di telefono: </strong>{{$restaurant->telephone_number}}</p>

      <p><strong>Indirizzo: </strong>{{$restaurant->address}}</p>

      <div>
        <img src="{{$restaurant->image_path}}" alt="">
      </div>


    </div>
    <p>{{$restaurant->image_original_name}}</p>

    <div class="pt-2">
        <span>Tipo:</span>
        <span class="badge text-bg-primary">{{$restaurant->type?->name}}</span>

    </div>

    <div class="pt-2">

    </div>



    <p class="pt-2">{!!$restaurant->text!!}</p>

    <a class="btn btn-warning nv_edit" href="{{route('admin.restaurants.edit', $restaurant)}}">
        <i class="fa-solid fa-pen"></i>
    </a>
  </div>
@endsection
