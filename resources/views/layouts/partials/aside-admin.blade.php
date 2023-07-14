<aside class="py-5">
  <ul class="list-unstyled">
    <li class="nav-item mb-4 {{Route::currentRouteName() === 'admin.home' ? 'active' : ''}}">
      <a class="nav-link" href=" {{ route('admin.home') }}"><i class="fa-solid fa-table-columns"></i> <span class="d-none d-md-inline">Dashboard</span></a>
    </li>

    <li class="nav-item mb-4 {{str_contains(Route::currentRouteName(), 'admin.restaurant')  ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('admin.restaurants.show', $restaurant) }}"><i class="fa-solid fa-utensils"></i> <span class="d-none d-md-inline">Ristorante</span></a>
    </li>

    <li class="nav-item mb-4 {{str_contains(Route::currentRouteName(), 'admin.dishes')  ? 'active' : ''}}">
      <a class="nav-link" href=" {{ route('admin.dishes.index') }}"><i class="fa-solid fa-bowl-food"></i> <span class="d-none d-md-inline">Piatti</span></a>
    </li>
  </ul>
</aside>
