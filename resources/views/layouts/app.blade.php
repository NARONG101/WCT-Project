<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Stock Management Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md flex flex-col">
    <div class="p-6 border-b border-gray-200 flex items-center justify-center space-x-3">
      <i class="fas fa-boxes text-indigo-600 text-3xl"></i>
      <span class="text-2xl font-bold text-indigo-600">StockDash</span>
    </div>
    <nav class="flex-1 p-6 space-y-3">
       <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded
        {{ request()->routeIs('dashbaord.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-indigo-600 hover:bg-indigo-100' }}">
        <i class="fas fa-clipboard-list mr-3"></i> dashboard
      </a>
      <a href="{{ route('inventory.index') }}" class="flex items-center px-3 py-2 rounded
        {{ request()->routeIs('inventory.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-indigo-600 hover:bg-indigo-100' }}">
        <i class="fas fa-clipboard-list mr-3"></i> Inventory Management
      </a>
      <a href="{{ route('suppliers.index') }}" class="flex items-center px-3 py-2 rounded
        {{ request()->routeIs('suppliers.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-indigo-600 hover:bg-indigo-100' }}">
        <i class="fas fa-truck mr-3"></i> Supplier Management
      </a>
      <a href="{{ route('orders.index') }}" class="flex items-center px-3 py-2 rounded
        {{ request()->routeIs('orders.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-indigo-600 hover:bg-indigo-100' }}">
        <i class="fas fa-cart-arrow-down mr-3"></i> Order & Restocking
      </a>
    </nav>
    <div class="p-6 border-t border-gray-200">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded font-semibold transition">
          Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-10 overflow-y-auto">
    <header class="mb-10">
      <h1 class="text-4xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
      <p class="text-gray-600 mt-2">@yield('page-subtitle')</p>
    </header>

    @yield('content')

  </main>

  @yield('scripts')

</body>
</html>
