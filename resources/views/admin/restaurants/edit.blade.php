@extends('layouts.admin')

@section('content')


  <div class="container py-5">
    <h1>Modifica il tuo ristorante!</h1>
    <form 
      action="{{route('admin.restaurants.store')}}" 
      method="POST" 
      class="mt-5" 
      enctype="multipart/form-data"
    >
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
        <input type="text" id="phone" placeholder="1234567890" pattern="[0-9]{10}" class="form-control @error('telephone_number') is-invalid @enderror" name="telephone_number" id="telephone_number" value="{{ old('telephone_number') }}">
        @error('telephone_number')
          <span class="text-danger">{{$message}}</span>
        @enderror
      </div>

      <div class="mb-3">
          <label for="image_path" class="form-label">Immagine</label>
          <input
              type="file"
              class="form-control"
              id="image_path"
              name="image_path"
              onchange="showImage(event)"
          >

          <img id="default-image" width="150px" src="{{ asset('storage/' . $restaurant->image_path) }}" alt="" onerror="this.src='/img/noimage.jpg'" class="pt-2">
      </div>

      <div class="mb-3 w-25">
          <label for="type_id" class="form-label">Tipo</label>
          <select class="form-select" aria-label="Default select example" name="type_id" id="type_id">
              <option value="" selected>Seleziona il tipo di lavoro</option>

              @foreach ($types as $type)
                  <option value="{{$type->id}}" @if($type->id == old('type_id', $restaurant->type?->id)) selected @endif>{{$type->name}}</option>
              @endforeach

          </select>
          @error('type_id')
              <p class="text-danger py-1">{{$message}}</p>
          @enderror
      </div>

      <button type="submit" class="btn btn-success">Modifica</button>

    </form>
  </div>

  <script>
      ClassicEditor
          .create( document.querySelector( '#text' ) )
          .catch( error => {
              console.error( error );
          } );

      function showImage(event){
          const tagImage = document.getElementById('default-image');
          tagImage.src = URL.createObjectURL(event.target.files[0]);
      }

      function removeImage(){
          const imageInput = document.getElementById('image_path');
          imageInput.value = '';
          const tagImage = document.getElementById('prev-image');
          tagImage.src = '';
      }

  </script>
@endsection
