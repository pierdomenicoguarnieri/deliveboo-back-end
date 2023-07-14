@extends('layouts.admin')

@section('content')


  <div class="container p-5">
    <h2 class="text-secondary mb-4"><strong>Ristorante: </strong>{{$restaurant->name}}</h2>

    <div>
      <p><strong>Email: </strong>{{$restaurant->email}}</p>

      <p><strong>Numero di telefono: </strong>{{$restaurant->telephone_number}}</p>

      <p><strong>Indirizzo: </strong>{{$restaurant->address}}</p>

      <div class="card-img-top d-block">
          <img src="{{ asset('storage/' . $restaurant->image_path) }}" alt="{{$restaurant->image_original_name}}" onerror="this.src='/img/noimage.jpg'" style="width: 500px">

      </div>
      <p>{{$restaurant->image_original_name}}</p>


    </div>
      <div class="pt-2">
          <strong>Tipo di ristorante:</strong>
          @forelse ( $restaurant->types as $type )
          <span class="badge text-bg-primary p-2">{{ $type->name}}</span>
          @empty
            <span>Non è stato selezionato il tipo di ristorante</span>
          @endforelse

      </div>

    <div class="pt-2">

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
@endsection
