@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your inventory, suppliers, and orders.')

@section('content')

<!-- 📊 Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
  
  <!-- Total Products -->
  <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center hover:shadow-lg transition">
    <i class="fas fa-boxes text-indigo-600 text-4xl mb-3"></i>
    <h2 class="text-3xl font-bold">{{ $totalProducts ?? 0 }}</h2>
    <p class="text-gray-600">Total Products</p>
    <a href="{{ route('inventory.index') }}" class="text-sm text-indigo-600 mt-2 hover:underline">View Products</a>
  </div>

  <!-- Total Suppliers -->
  <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center hover:shadow-lg transition">
    <i class="fas fa-truck text-indigo-600 text-4xl mb-3"></i>
    <h2 class="text-3xl font-bold">{{ $totalSuppliers ?? 0 }}</h2>
    <p class="text-gray-600">Total Suppliers</p>
    <a href="{{ route('suppliers.index') }}" class="text-sm text-indigo-600 mt-2 hover:underline">View Suppliers</a>
  </div>

  <!-- Pending Orders -->
  <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center hover:shadow-lg transition">
    <i class="fas fa-cart-arrow-down text-indigo-600 text-4xl mb-3"></i>
    <h2 class="text-3xl font-bold">{{ $pendingOrders ?? 0 }}</h2>
    <p class="text-gray-600">Pending Orders</p>
    <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 mt-2 hover:underline">View Orders</a>
  </div>

  <!-- Low Stock Alerts -->
  <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center hover:shadow-lg transition">
    <i class="fas fa-exclamation-triangle text-red-600 text-4xl mb-3"></i>
    <h2 class="text-3xl font-bold">{{ $lowStockCount ?? 0 }}</h2>
    <p class="text-gray-600">Low Stock Alerts</p>
    <a href="{{ route('inventory.index', ['filter' => 'low_stock']) }}" class="text-sm text-red-600 mt-2 hover:underline">View Low Stock</a>
  </div>

</div>

<!-- 📈 Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

  <!-- Inventory Bar Chart -->
  <div class="bg-white rounded-2xl shadow p-6">
    <h3 class="text-xl font-semibold mb-4">Stock Levels Overview</h3>
    <canvas id="inventoryChart" class="w-full h-64"></canvas>
  </div>

  <!-- Orders Doughnut Chart -->
  <div class="bg-white rounded-2xl shadow p-6">
    <h3 class="text-xl font-semibold mb-4">Purchase Orders Status</h3>
    <canvas id="ordersChart" class="w-full h-64"></canvas>
  </div>

</div>

@endsection

@section('scripts')
<script>
  // 📊 Inventory Chart
  const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
  new Chart(inventoryCtx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($productNames ?? ['Product A', 'Product B', 'Product C']) !!},
      datasets: [{
        label: 'Quantity in Stock',
        data: {!! json_encode($productQuantities ?? [12, 7, 3]) !!},
        backgroundColor: 'rgba(99, 102, 241, 0.7)',
        borderColor: 'rgba(99, 102, 241, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: { precision: 0 }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `Quantity: ${context.parsed.y}`;
            }
          }
        }
      }
    }
  });

  // 🟢 Orders Doughnut Chart
  const ordersCtx = document.getElementById('ordersChart').getContext('2d');
  new Chart(ordersCtx, {
    type: 'doughnut',
    data: {
      labels: ['Pending', 'Completed'],
      datasets: [{
        data: {!! json_encode([$pendingOrders ?? 0, $completedOrders ?? 0]) !!},
        backgroundColor: ['#FBBF24', '#22C55E'],
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.label}: ${context.parsed}`;
            }
          }
        }
      }
    }
  });
</script>
@endsection
