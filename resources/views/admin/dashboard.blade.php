@extends('layouts.admin')

@if (Auth::user()->restaurant_id != null && $restaurant != null)

  @section('content')
    <div class="h-100 w-100 pb-3">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-6 d-flex justify-content-center">
                <div class="orders">
                    <p class="counter-count-animate">{{count($orders)}}</p>
                    <p class="orders-p">Tot. Ordini ricevuti</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-6 d-flex justify-content-center">
                <div class="dishes">
                    <p class="counter-count-animate">{{count($dishes)}}</p>
                    <p class="dishes-p">Tot. Piatti inseriti</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-12 d-flex justify-content-center">
                <div class="totorder">
                    <p class="counter-count">{{$sum_formatted}}</p>
                    <p class="totorder-p">Tot. incasso <span>(&euro;)</span></p>
                </div>
            </div>
        </div>
      <div class="statistics">
        <div id="seven" class="h-100">
          <canvas id="lastSeven"></canvas>
        </div>
        <div id="thirty" class="h-100">
          <canvas id="lastThirty"></canvas>
        </div>
        <div id="year" class="h-100">
          <canvas id="lastYear"></canvas>
        </div>
        {{-- <button id="changeRange"></button> --}}
        <div class="select-container mt-3 w-25">
          <select id="changeRange" class="form-select" class="my-3">
            <option value="1">Sette giorni</option>
            <option value="2">Trenta giorni</option>
            <option value="3">Ultimo anno</option>
          </select>
        </div>
      </div>
    </div>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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

      const sevenDates          = {};
                                  for (let i = 0; i < 7; i++) {
                                    sevenDates[i] = [];
                                  };
      const sevenDaysLabels     = [];
      const sevenDatesCount     = [];
      const thirtyDaysLabels    = [];
      const thirtyDates         = {}
                                  for (let i = 0; i < 30; i++) {
                                    thirtyDates[i] = [];
                                  };
      const thirtyDatesCount    = [];
      const lastYearMonths      = [];
      const lastYearDates       = {};
                                  for (let i = 0; i < 13; i++) {
                                    lastYearDates[i] = [];
                                  };
      const lastYearDatesCount  = [];
      const monthsLabels        = [];
      const ordersMonth         = [];

      const changeRange         = document.getElementById('changeRange');
                                  changeRange.addEventListener('change', function() {
                                    if (changeRange.value == 1) {
                                      seven.classList.remove('graphic-hide');
                                      thirty.classList.add('graphic-hide');
                                      year.classList.add('graphic-hide');
                                    }
                                    if (changeRange.value == 2) {
                                      seven.classList.add('graphic-hide');
                                      thirty.classList.remove('graphic-hide');
                                      year.classList.add('graphic-hide');
                                    }
                                    if (changeRange.value == 3) {
                                      seven.classList.add('graphic-hide');
                                      thirty.classList.add('graphic-hide');
                                      year.classList.remove('graphic-hide');
                                    }
                                  })

      // id, n, labels, dates, count
      graphic(lastSeven, 6, sevenDaysLabels, sevenDates, sevenDatesCount);
      graphic(lastThirty, 30, thirtyDaysLabels, thirtyDates, thirtyDatesCount);

      // graphic lastYear

      // array ultimo anno per le labels
      for (let i = 11; i >= 0; i--) {
        let month = dt.minus({months: i}).toISODate()
        lastYearMonths.push(DateTime.fromISO(month).month)
        let monthLabel = DateTime.fromISO(month).toLocaleString({ month: 'long'});
        monthsLabels.push(monthLabel);
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
          if (order == lastYearMonths[i]) lastYearDates[i].push(order);
        }
      })

      // count degli ordini dell'ultimo anno
      for (const month in lastYearDates) {
        lastYearDatesCount.push(lastYearDates[month].length);
      }

      new Chart(lastYear, {
        type: 'line',
        data: {
          labels: monthsLabels,
          datasets: [{
            label: 'Numero di ordini dell\'ultimo anno',
            data: lastYearDatesCount,
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
            }
          },
          tension: .4
        }
      });

      function graphic(id, n, labels, dates, count) {
        // array ultimi sette giorni per le labels
        for (let i = n; i >= 0; i--) {
          labels.push(dt.minus({days: i}).toISODate())
        }

        //ordini degli ultimi sette giorni
        orders.forEach(order => {
          for (let i = n; i >= 0; i--) {
            if (order == dt.minus({days: i}).toISODate()) dates[i].push(order);
          }
        });

        // count degli ordini degli ultimi sette giorni
        for (const day in dates) {
          count.push(dates[day].length);
        }
        count.reverse();

        new Chart(id, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: 'Numero di ordini negli ultimi sette giorni',
              data: count,
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
            },
            tension: .4,
          }
        });
      }
      $('.counter-count-animate').each(function () {
          $(this).prop('Counter',0).animate({
              Counter: $(this).text()
          }, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                  $(this).text(Math.ceil(now));
              }
          });
      });
    </script>
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
