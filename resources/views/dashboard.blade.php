<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
      <a class="font-semibold text-xl text-gray-800 leading-tight" href="{{ route('order.index') }}">Orders</a>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                  @include('message')
              <!-- creation -->
              <!-- Button to Open Modal -->
<div class="flex justify-end mb-4">
<button
  class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none"
  onclick="openModal()"
>
  Create New Product
</button>
</div>

<!-- Modal Background -->
<div
class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 hidden"
id="productModal"
>
<!-- Modal Content -->
<div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">
  <!-- Modal Header -->
  <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
    <h3 class="text-lg font-semibold text-gray-700">Create New Product</h3>
    <button
      class="text-gray-400 hover:text-gray-600 focus:outline-none"
      onclick="closeModal()"
    >
      <svg
        class="h-6 w-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12"
        ></path>
      </svg>
    </button>
  </div>

  <!-- Modal Body -->
  <form class="px-6 py-4 space-y-4" method="POST" action="{{route('product.store')}}">
      @csrf 
    <!-- Product Name -->
    <div>
      <label for="productName" class="block text-sm font-medium text-gray-600">Product Name</label>
      <input
        type="text"
        id="productName"
        name="name"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
        placeholder="Enter product name"
        required
      />
    </div>

    <!-- Product Description -->
    <div>
      <label for="productDescription" class="block text-sm font-medium text-gray-600">Description</label>
      <textarea
        id="productDescription"
        rows="3"
        name="description"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
        placeholder="Enter product description"
      ></textarea>
    </div>

    <!-- Product Price -->
    <div>
      <label for="productPrice" class="block text-sm font-medium text-gray-600">Price</label>
      <input
        type="number"
        id="productPrice"
        name="price"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
        placeholder="Enter product price"
        step="0.01"
        required
      />
    </div>

    <!-- Product Image -->
    <div>
      <label for="productImage" class="block text-sm font-medium text-gray-600">Product Image</label>
      <input
        type="text"
        id="productImage"
        name="image_url"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
       
      />
    </div>
    <button
      type="submit"
      class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none"
    >
      Create Product
    </button>
  </form>

  <!-- Modal Footer -->
  <div class="flex justify-end items-center border-t border-gray-200 px-6 py-4">
    <button
      type="button"
      class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none"
      onclick="closeModal()"
    >
      Cancel
    </button>
 
  </div>
</div>
</div>

<script>
function openModal() {
  document.getElementById('productModal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('productModal').classList.add('hidden');
}
</script>


              <!-- end creation -->
              <!-- product management -->
              <div class="container mx-auto mt-10 px-4">
                  <h2 class="text-2xl font-bold mb-6 text-gray-800">Product Management</h2>
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <!-- Product Card -->
                     @foreach($products as $product)
                     <div class="bg-white border rounded-lg shadow-lg overflow-hidden">
                      <img src="{{$product->image_path}}" alt="Product A" class="w-full h-48 object-cover">
                      <div class="p-4">
                          <h3 class="text-lg font-semibold text-gray-800">{{$product->name}}</h3>
                          <p class="text-sm text-gray-600">{{$product->description}}</p>
                          <p class="text-lg font-medium text-gray-900 mt-2">NGN {{$product->price }}</p>
                      </div>
                      <div class="flex justify-between p-4 border-t">
                          <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                          <a href="{{route('product.destroy', $product->id)}}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</a>
                      </div>
                      </div>

                     @endforeach 
                     

                      <!-- Add more cards as needed -->
                  </div>
              </div>

              <!-- end product management -->
              </div>
          </div>
      </div>
  </div>
</x-app-layout>