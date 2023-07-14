@extends('admin.dashboard')

@section('content')


  <div class="container rounded-3 bg-white border border-1 py-4">
    <div class="content-wrapper bg-white w-100">
      <h2 class="text-secondary mb-4">{{$restaurant->name}}</h2>

      <div>
        <p><strong>Email: </strong>{{$restaurant->email}}</p>

        <p><strong>Numero di telefono: </strong>{{$restaurant->telephone_number}}</p>

        <p><strong>Indirizzo: </strong>{{$restaurant->address}}</p>

        <div class="card-img-top d-block">
          <img src="{{ asset('storage/' . $restaurant->image_path) }}" class="img-fluid" alt="{{$restaurant->image_original_name}}" onerror="this.src='/img/noimage.jpg'">
        </div>
        <p>{{$restaurant->image_original_name}}</p>


      </div>
        <div class="pt-2">
            <span>Tipo:</span>
            @foreach ($restaurant->types as $type)
              <span class="badge text-bg-primary text-capitalize">{{ $type->name}}</span>
            @endforeach

        </div>

      <div class="pt-2">

      </div>

      <a class="btn btn-warning nv_edit" href="{{route('admin.restaurants.edit', $restaurant)}}">
        <i class="fa-solid fa-pencil"></i>
      </a>
    </div>

  </div>
@endsection
