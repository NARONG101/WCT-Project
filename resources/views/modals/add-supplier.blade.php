<div id="addSupplierModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-xl font-bold text-gray-800">Add New Supplier</h3>
            <button onclick="document.getElementById('addSupplierModal').classList.add('hidden')" 
                class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Supplier Name</label>
                    <input type="text" name="name" required 
                           class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Contact Person</label>
                    <input type="text" name="contact_person" required 
                           class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" required 
                           class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 mb-2">Address</label>
                    <textarea name="address" required 
                              class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" 
                        class="bg-primary hover:bg-indigo-700 text-white py-2 px-4 rounded-lg">
                    Add Supplier
                </button>
                <button type="button" 
                        onclick="document.getElementById('addSupplierModal').classList.add('hidden')" 
                        class="ml-2 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>