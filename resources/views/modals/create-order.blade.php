<div id="createOrderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-bold text-gray-800">Create New Order</h3>
            <button onclick="document.getElementById('createOrderModal').classList.add('hidden')" 
                class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Supplier</label>
                <select name="supplier_id" required class="w-full px-4 py-2 border rounded-lg">
                    @foreach(\App\Models\Supplier::all() as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="order-items" class="mb-4">
                <div class="flex items-center mb-2">
                    <select name="items[0][product_id]" required class="flex-1 px-4 py-2 border rounded-lg mr-2">
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][quantity]" min="1" value="1" required 
                           class="w-20 px-4 py-2 border rounded-lg">
                </div>
            </div>

            <button type="button" id="add-item" 
                    class="mb-4 text-primary flex items-center">
                <i class="fas fa-plus mr-1"></i> Add Item
            </button>

            <div class="mt-6">
                <button type="submit" 
                        class="bg-primary hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Create Order
                </button>
                <button type="button" 
                        onclick="document.getElementById('createOrderModal').classList.add('hidden')" 
                        class="ml-2 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                    Cancel
                </button>
            </div>
        </form>

        <script>
            document.getElementById('add-item').addEventListener('click', function() {
                const container = document.getElementById('order-items');
                const index = container.children.length;
                const div = document.createElement('div');
                div.className = 'flex items-center mb-2';
                div.innerHTML = `
                    <select name="items[${index}][product_id]" required class="flex-1 px-4 py-2 border rounded-lg mr-2">
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[${index}][quantity]" min="1" value="1" required 
                           class="w-20 px-4 py-2 border rounded-lg">
                    <button type="button" class="remove-item text-red-500 ml-2">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                container.appendChild(div);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-item')) {
                    e.target.closest('div').remove();
                }
            });
        </script>
    </div>
</div>