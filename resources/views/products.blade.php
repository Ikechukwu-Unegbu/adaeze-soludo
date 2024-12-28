<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co. - Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Backpack Co.</h1>
            <nav>
                <ul class="hidden md:flex space-x-6 text-gray-600">
                    <li><a href="index.html" class="hover:text-gray-800">Home</a></li>
                    <li><a href="#" class="hover:text-gray-800">Products</a></li>
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
            <li><a href="#" class="hover:text-gray-800">Products</a></li>
            <li><a href="contact.html" class="hover:text-gray-800">Contact</a></li>
        </ul>
    </header>

    <main class="py-16 px-4">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Our Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition">
                        <img src="{{ $product->image_path ? $product->image_path : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
                        <h4 class="text-lg font-semibold text-gray-800 mt-4">{{ $product->name }}</h4>
                        <p class="text-gray-600 mt-2">{{ Str::limit($product->description, 50) }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-green-600">NGN {{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('product.show', $product->id) }}" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition">View Details</a>
                        </div>
                    </div>
                @endforeach

                <!-- Add more products as needed -->
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
