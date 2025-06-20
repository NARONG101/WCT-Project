<div id="addProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-bold text-gray-800">Add New Product</h3>
            <button onclick="document.getElementById('addProductModal').classList.add('hidden')" 
                class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Category</label>
                    <input type="text" name="category" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Quantity</label>
                    <input type="number" name="quantity" min="0" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Price</label>
                    <input type="number" name="price" step="0.01" min="0" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-primary focus:border-primary">
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" 
                        class="bg-primary hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Add Product
                </button>
                <button type="button" 
                        onclick="document.getElementById('addProductModal').classList.add('hidden')" 
                        class="ml-2 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>