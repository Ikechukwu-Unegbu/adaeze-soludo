<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co. - Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Backpack Co.</h1>
            <nav>
                <ul class="hidden md:flex space-x-6 text-gray-600">
                    <li><a href="index.html" class="hover:text-gray-800">Home</a></li>
                    <li><a href="products.html" class="hover:text-gray-800">Products</a></li>
                    <li><a href="contact.html" class="hover:text-gray-800">Contact</a></li>
                </ul>
                <button id="menu-btn" class="block md:hidden text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>
        </div>
        <ul id="mobile-menu" class="hidden flex flex-col space-y-4 px-4 py-6 bg-white shadow-md md:hidden">
            <li><a href="index.html" class="hover:text-gray-800">Home</a></li>
            <li><a href="products.html" class="hover:text-gray-800">Products</a></li>
            <li><a href="contact.html" class="hover:text-gray-800">Contact</a></li>
        </ul>
    </header>

    <main class="py-16 px-4">
        <div class="container mx-auto max-w-4xl bg-white shadow-lg rounded-lg p-6">
        <div class="fixed top-5 right-5 z-50">
    @if (session('success'))
        <div class="bg-green-500 text-white font-semibold py-2 px-4 rounded-md shadow-lg flex items-center space-x-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
</div>

            <div class="flex flex-col md:flex-row md:space-x-6">
                <div class="flex-shrink-0">
                    <img src="{{$product->image_path? $product->image_path: 'https://via.placeholder.com/300'}}" alt="Product Image" class="w-full md:w-64 h-64 object-cover rounded">
                </div>
                <div class="mt-4 md:mt-0">
                    <h2 class="text-2xl font-bold text-gray-800">{{$product->name}}</h2>
                    <p class="text-gray-600 mt-2">{{$product->description}}</p>
                    <p class="text-xl font-semibold text-blue-500 mt-4">Price: NGN {{$product->price}}</p>

                    <div class="mt-6">
                        <a href="{{route('cart.store', $product->id)}}" id="add-to-cart" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600">
                            Add to Cart
                        </a>
                        <a href="cart.html" class="ml-4 bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600">
                            View Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-16">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Backpack Co. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

       
    </script>
</body>
</html>
