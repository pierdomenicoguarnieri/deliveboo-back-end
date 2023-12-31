@extends('layouts.admin')

@section('content')
<div class="container h-100 d-flex align-items-center justify-content-center">
  <div class="card h-75 w-100 border-0 bg-transparent m-0 text-bg-dark">
    <img
    src="{{ asset('storage/' . $restaurant->image_path) }}"
    alt="{{$restaurant->image_original_name}}"
    onerror="this.src='/img/noimage.jpg'"
    class="img-fluid h-100 object-fit-cover rounded-5 shadow-sm overflow-hidden card-img">
    <div class="card-img-overlay bg-dark bg-opacity-50 rounded-5">
      <div class="restaurant-info overflow-y-auto h-100 d-flex flex-column">
        <h2 class="text-center fs-1 mb-4">{{$restaurant->name}}</h2>

        <div class="infos fs-4">
          <p class="py-1"><strong>Email: </strong>{{$restaurant->email}}</p>

          <p class="py-1"><strong>Numero di telefono: </strong>{{$restaurant->telephone_number}}</p>

          <p class="py-1"><strong>Indirizzo: </strong>{{$restaurant->address}}</p>

          <p class="pt-1"><strong>P. IVA: </strong>{{$restaurant->piva}}</p>

          <div class="pt-1">
              <strong>Tipo di ristorante:</strong>
              @forelse ( $restaurant->types as $type )
              <span class="badge text-bg-danger bg-opacity-75 text-capitalize p-2">{{ $type->name}}</span>
              @empty
                <span>Non è stato selezionato il tipo di ristorante</span>
              @endforelse
          </div>
        </div>
        <div class="buttons-container pt-4">
          <a class="btn btn-warning nv_edit" href="{{route('admin.restaurants.edit', $restaurant)}}">
            <i class="fa-solid fa-pencil"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
