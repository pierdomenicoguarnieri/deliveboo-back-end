@extends('admin.dashboard')

@section('content')
  <div class="container rounded-3 bg-white border border-1 py-4">
    <div class="content-wrapper bg-white w-100">
      <h2 class="text-secondary mb-4"><strong>Ristorante: </strong>{{$restaurant->name}}</h2>

      <p class="py-1"><strong>Email: </strong>{{$restaurant->email}}</p>

      <p class="py-1"><strong>Numero di telefono: </strong>{{$restaurant->telephone_number}}</p>

      <p class="py-1"><strong>Indirizzo: </strong>{{$restaurant->address}}</p>

      <p class="pt-1 pb-4"><strong>P. IVA: </strong>{{$restaurant->piva}}</p>

      <div class="card-img-top d-block">
        <img src="{{ asset('storage/' . $restaurant->image_path) }}" alt="{{$restaurant->image_original_name}}" onerror="this.src='/img/noimage.jpg'" style="width: 500px">
      </div>
      <p class="py-1"><strong>Nome immagine: </strong>{{$restaurant->image_name}}</p>
      <div class="py-2">
          <strong>Tipo di ristorante:</strong>
          @forelse ( $restaurant->types as $type )
          <span class="badge text-bg-primary p-2">{{ $type->name}}</span>
          @empty
            <span>Non è stato selezionato il tipo di ristorante</span>
          @endforelse
      </div>

      <div class="pt-2">

        <a class="btn btn-warning nv_edit" href="{{route('admin.restaurants.edit', $restaurant)}}">
          <i class="fa-solid fa-pencil"></i>
        </a>
      </div>

      <a class="btn btn-warning nv_edit" href="{{route('admin.restaurants.edit', $restaurant)}}">
          <i class="fa-regular fa-pen-to-square"></i>
      </a>

      @include('admin.partials.form-delete',[
          'title' => 'Eliminazione Ristorante',
          'id' => $restaurant->id,
          'message' => "Confermi l'eliminazione del tuo ristorante: $restaurant->name ?",
          'route' => route('admin.restaurants.destroy', $restaurant)
      ])

    </div>
  </div>
@endsection
