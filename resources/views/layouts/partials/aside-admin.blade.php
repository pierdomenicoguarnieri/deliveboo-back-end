<aside class="pb-3 px-3 overflow-y-auto overflow-x-hidden">

  <div class="img-container mb-lg-5 mb-md-4 mb-3 mt-5">
    <a class="navbar-brand d-flex align-items-center h-100" href="{{ url('/') }}">
      <img src="/img/Ghost_Orange_Text_Orange.png" class="d-md-inline-block d-none" alt="">
      <img src="/img/Ghost_Orange.svg" class="d-md-none svg" alt="">
    </a>
  </div>

  @auth
  <ul class="list-unstyled">
    <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{Route::currentRouteName() === 'admin.home' ? 'active' : ''}}">
      <a class="nav-link" href=" {{ route('admin.home') }}"><i class="fa-solid fa-table-columns"></i> <span class="d-none d-md-inline">Dashboard</span></a>
    </li>

    @if (Auth::user()->restaurant_id != null && $restaurant != null)
      <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{str_contains(Route::currentRouteName(), 'admin.restaurant')  ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.restaurants.show', $restaurant) }}"><i class="fa-solid fa-utensils"></i> <span class="d-none d-md-inline">Ristorante</span></a>
      </li>

      <div class="accordion mb-lg-4 mb-md-3 mb-2" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button {{Route::currentRouteName() === 'admin.dishes.index' || str_contains(Route::currentRouteName(), 'admin.dishes.edit') || str_contains(Route::currentRouteName(), 'admin.dishes.show') || Route::currentRouteName() === 'admin.dishes.create' || Route::currentRouteName() === 'admin.deleted.dishes' ? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              <div class="text">
                <i class="fa-solid fa-bowl-food me-1"></i> <span class="d-none d-md-inline">Piatti</span>
              </div>
            </button>
          </h2>
          <div
          id="collapseOne"
          class="accordion-collapse collapse {{Route::currentRouteName() === 'admin.dishes.index' || str_contains(Route::currentRouteName(), 'admin.dishes.edit') || str_contains(Route::currentRouteName(), 'admin.dishes.show') || Route::currentRouteName() === 'admin.dishes.create' || Route::currentRouteName() === 'admin.deleted.dishes' ? 'show' : ''}}"
          data-bs-parent="#accordionExample">

            <div class="accordion-body w-100 px-0 px-sm px-md-4">
              <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{Route::currentRouteName() === 'admin.dishes.index' || str_contains(Route::currentRouteName(), 'admin.dishes.edit') || str_contains(Route::currentRouteName(), 'admin.dishes.show')  ? 'active' : ''}}">
                <a class="nav-link" href=" {{ route('admin.dishes.index') }}"><i class="fa-solid fa-list"></i> <span class="d-none d-md-inline">Lista Piatti</span></a>
              </li>

              <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{Route::currentRouteName() === 'admin.dishes.create'  ? 'active' : ''}}">
                <a class="nav-link" href=" {{ route('admin.dishes.create') }}"><i class="fa-regular fa-square-plus"></i> <span class="d-none d-md-inline">Nuovo Piatto</span></a>
              </li>

              <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{Route::currentRouteName() === 'admin.deleted.dishes'  ? 'active' : ''}}">
                <a class="nav-link" href=" {{ route('admin.deleted.dishes') }}"><i class="fa-solid fa-trash"></i> <span class="d-none d-md-inline">Piatti Eliminati</span></a>
              </li>
            </div>
          </div>
        </div>
      </div>


      <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{str_contains(Route::currentRouteName(), 'admin.orders')  ? 'active' : ''}}">
        <a class="nav-link" href=" {{ route('admin.orders.index') }}"><i class="fa-solid fa-list-ul"></i> <span class="d-none d-md-inline">Ordini</span></a>
      </li>
    @endif
  </ul>

  <ul class="list-unstyled mt-auto">
    <li class="nav-item mb-lg-4 mb-md-3 mb-2">
      <a class="nav-link" href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket"></i> <span class="d-none d-md-inline">Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
  @endauth

  @guest
  <ul class="list-unstyled">
    <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{str_contains(Route::currentRouteName(), 'login')  ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> <span class="d-none d-md-inline">Login</span></a>
    </li>
    @if (Route::has('register'))
      <li class="nav-item mb-lg-4 mb-md-3 mb-2 {{str_contains(Route::currentRouteName(), 'register')  ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-clipboard"></i> <span class="d-none d-md-inline">Register</span></a>
      </li>
    @endif
  </ul>
  @endguest
</aside>
