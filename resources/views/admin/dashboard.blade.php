@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null && $restaurant != null)

  @section('content')
    <div class="container">
      <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js'></script>

    <script>
      const DateTime = luxon.DateTime;
      const orders = {!! json_encode($orders) !!};
      const ctx = document.getElementById('myChart');

      const dt = DateTime.now().set({ hour: 00, minutes: 00, seconds: 00, milliseconds: 00 }).setLocale('it');

      console.log(dt.minus({days: 6}).toISODate());
      console.log(dt.minus({days: 5}).toISODate());
      console.log(dt.minus({days: 4}).toISODate());
      console.log(dt.minus({days: 3}).toISODate());
      console.log(dt.minus({days: 2}).toISODate());
      console.log(dt.minus({days: 1}).toISODate());
      console.log(dt.toISODate());

      orders.forEach(order => {
        console.log(order.created_at);
      });
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Lun', 'Mar', 'Mer', 'Giov', 'Ven', 'Sab', 'Dom'],
          datasets: [{
            label: 'Numero di ordini',
            data: [12, 19, 3, 5, 2, 3, 12],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
  @endsection

  @elseif(Auth::user()->restaurant_id != null && $restaurant === null)
    @section('content')
    <div class="container">

      <h2 class="fs-4 text-secondary my-4">
          Attenzione!
      </h2>
      <div class="row justify-content-center">
          <div class="col">
              <div class="card boo-wrapper border-0">
                  <div class="card-body">
                      @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                      @endif
                      <div>
                        <span class="d-block mb-3">Attenzione <strong>{{Auth::user()->name}}</strong>, il tuo ristorante è disattivato, per usare la tua dashboard riattivalo!</span>
                        <form action="{{ route('admin.restore.restaurant', Auth::user()->restaurant_id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <button class="btn btn-success" type="submit">
                            Riattiva il tuo ristorante!
                          </button>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    @endsection

  @else
    @section('content')
      <div class="container">
        <h2 class="fs-4 text-secondary my-4">
          Attenzione!
        </h2>
        <div class="row justify-content-center">
          <div class="col">
            <div class="card boo-wrapper border-0">
              <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                  @endif
                  <div>
                    <span class="d-block">Attenzione <strong>{{Auth::user()->name}}</strong>, non hai ancora aggiunto un ristorante!</span>
                    <a href="{{route('admin.restaurants.create')}}" class="btn btn-success mt-3">Aggiungi ora un ristorante!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endsection
@endif
