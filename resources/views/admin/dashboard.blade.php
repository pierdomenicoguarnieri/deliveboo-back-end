@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null && $restaurant != null)

  @section('content')
    <div class="container">
      <div id="seven">
        <canvas id="lastSeven"></canvas>
      </div>
      <div id="thirty">
        <canvas id="lastThirty"></canvas>
      </div>
      <div id="year">
        <canvas id="lastYear"></canvas>
      </div>
      {{-- <button id="changeRange"></button> --}}
      <select id="changeRange">
        <option value="1">Sette giorni</option>
        <option value="2">Trenta giorni</option>
        <option value="3">Ultimo anno</option>
      </select>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js'></script>

    <script>
      const orders              = {!! json_encode($orders) !!};
      const DateTime            = luxon.DateTime;
      const dt                  = DateTime.now().set({ hour: 00, minutes: 00, seconds: 00, milliseconds: 00 }).setLocale('it');

      const seven               = document.getElementById('seven');
      const lastSeven           = document.getElementById('lastSeven');
      const thirty              = document.getElementById('thirty');
                                  thirty.classList.add('graphic-hide');
      const lastThirty          = document.getElementById('lastThirty');
      const year                = document.getElementById('year');
                                  year.classList.add('graphic-hide');
      const lastYear            = document.getElementById('lastYear');
      
      const lastSevenDay        = [];     
      const lastSevenDate       = {
                                    0: [],
                                    1: [],
                                    2: [],
                                    3: [],
                                    4: [],
                                    5: [],
                                    6: [],
                                  };
      const lastSevenDateCount  = [];
      const lastThirtyDay       = [];
      const lastThirtyDate      = {
                                    0: [],
                                    1: [],
                                    2: [],
                                    3: [],
                                    4: [],
                                    5: [],
                                    6: [],
                                    6: [],
                                    7: [],
                                    8: [],
                                    9: [],
                                    10: [],
                                    11: [],
                                    12: [],
                                    13: [],
                                    14: [],
                                    15: [],
                                    16: [],
                                    17: [],
                                    18: [],
                                    19: [],
                                    20: [],
                                    21: [],
                                    22: [],
                                    23: [],
                                    24: [],
                                    25: [],
                                    26: [],
                                    27: [],
                                    28: [],
                                    29: [],
                                  };
      const lastThirtyDateCount = [];
      const lastYearMonth       = [];
      const lastYearDate        = {
                                    0: [],
                                    1: [],
                                    2: [],
                                    3: [],
                                    4: [],
                                    5: [],
                                    6: [],
                                    6: [],
                                    7: [],
                                    8: [],
                                    9: [],
                                    10: [],
                                    11: [],
                                  };
      const lastYearDateCount   = [];
      const monthsLabels         = [];
      const ordersMonth         = [];

      const changeRange         = document.getElementById('changeRange');
                                  changeRange.addEventListener('change', function() {
                                   if (changeRange.value == 1) {
                                     seven.classList.remove('graphic-hide');
                                     thirty.classList.add('graphic-hide');
                                     year.classList.add('graphic-hide');
                                     console.log(1);
                                   } 
                                   if (changeRange.value == 2) {
                                     seven.classList.add('graphic-hide');
                                     thirty.classList.remove('graphic-hide');
                                     year.classList.add('graphic-hide');
                                     console.log(2);
                                   }
                                   if (changeRange.value == 3) {
                                     seven.classList.add('graphic-hide');
                                     thirty.classList.add('graphic-hide');
                                     year.classList.remove('graphic-hide');
                                     console.log(3);
                                   }
                                   console.log(changeRange.value == 1);
                                  })



    
      // array ultimi sette giorni per le labels
      for (let i = 6; i >= 0; i--) {
        lastSevenDay.push(dt.minus({days: i}).toISODate())
      }
      
      //ordini degli ultimi sette giorni
      orders.forEach(order => {
        for (let i = 6; i >= 0; i--) {
          if (order == dt.minus({days: i}).toISODate()) lastSevenDate[i].push(order);
        }
      });
      
      // count degli ordini degli ultimi sette giorni
      for (const day in lastSevenDate) {
        lastSevenDateCount.push(lastSevenDate[day].length);
      }
      lastSevenDateCount.reverse()

      new Chart(lastSeven, {
        type: 'line',
        data: {
          labels: lastSevenDay,
          datasets: [{
            label: 'Numero di ordini negli ultimi sette giorni',
            data: lastSevenDateCount,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            },
          }
        }
      });




      // array ultimi 30 giorni per le labels
      for (let i = 30; i >= 0; i--) {
        lastThirtyDay.push(dt.minus({days: i}).toISODate())
      }

      // ordini degli ultimi 30 giorni
      orders.forEach(order => {
        for (let i = 30; i >= 0; i--) {
          if (order == dt.minus({days: i}).toISODate()) lastThirtyDate[i].push(order);
        }
      });

      // count degli ordini degli ultimi 30 giorni
      for (const day in lastThirtyDate) {
        lastThirtyDateCount.push(lastThirtyDate[day].length);
      }
      lastThirtyDateCount.reverse()

      new Chart(lastThirty, {
        type: 'line',
        data: {
          labels: lastThirtyDay,
          datasets: [{
            label: 'Numero di ordini negli ultimi trenta giorni',
            data: lastThirtyDateCount,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            },
          }
        }
      });




      // array ultimo anno per le labels
      for (let i = 11; i >= 0; i--) {
        let month = dt.minus({months: i}).toISODate()
        lastYearMonth.push(DateTime.fromISO(month).month)
        let monthLabel = DateTime.fromISO(month).toLocaleString({ month: 'long'});
        monthsLabels.push(monthLabel);
        console.log(monthsLabels);
      }
      
      // lettura dei soli mesi degli ordini
      orders.forEach(order => {
        let orderDate = DateTime.fromISO(order);
        let orderMonth = orderDate.month;
        ordersMonth.push(orderMonth);
      });
      
      // ordini dell'ultimo anno 
      ordersMonth.forEach(order => {
        for (let i = 11; i >= 0; i--) {
          if (order == lastYearMonth[i]) lastYearDate[i].push(order);
        }
      })
      
      // count degli ordini dell'ultimo anno
      for (const month in lastYearDate) {
        lastYearDateCount.push(lastYearDate[month].length);
      }

      new Chart(lastYear, {
        type: 'line',
        data: {
          labels: monthsLabels,
          datasets: [{
            label: 'Numero di ordini dell\'ultimo anno',
            data: lastYearDateCount,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            },
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
