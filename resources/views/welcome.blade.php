<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co.</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Backpack Co.</h1>
            <nav>
                <ul class="hidden md:flex space-x-6 text-gray-600">
                    <li><a href="#" class="hover:text-gray-800">Home</a></li>
                    <li><a href="#about" class="hover:text-gray-800">About</a></li>
                    <li><a href="{{route('product.index')}}" class="hover:text-gray-800">Products</a></li>
                    <li><a href="#contact" class="hover:text-gray-800">Contact</a></li>
                </ul>
                <button id="menu-btn" class="block md:hidden text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>
        </div>
        <ul id="mobile-menu" class="hidden flex flex-col space-y-4 px-4 py-6 bg-white shadow-md md:hidden">
            <li><a href="#" class="hover:text-gray-800">Home</a></li>
            <li><a href="#about" class="hover:text-gray-800">About</a></li>
            <li><a href="#products" class="hover:text-gray-800">Products</a></li>
            <li><a href="#contact" class="hover:text-gray-800">Contact</a></li>
        </ul>
    </header>

    <main>
        <section class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-4">Adventure Starts Here</h2>
                <p class="text-lg mb-6">Discover our collection of durable, stylish backpacks for every journey.</p>
                <a href="{{route('product.index')}}" class="bg-white text-blue-500 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition">Shop Now</a>
            </div>
        </section>

        <section id="about" class="py-16 px-4">
            <div class="container mx-auto text-center">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Why Choose Backpack Co.?</h3>
                <p class="text-gray-600 leading-relaxed">At Backpack Co., we combine style, comfort, and durability to create the perfect backpacks for every occasion. Whether you're hiking, commuting, or exploring, we've got you covered.</p>
            </div>
        </section>

        <section id="products" class="bg-gray-50 py-16 px-4">
            <div class="container mx-auto text-center">
                <h3 class="text-3xl font-bold text-gray-800 mb-8">Our Products</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($products as $product)
                    <a href="{{route('product.show', $product->id)}}" class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition">
                        <img src="{{ $product->image_path ? $product->image_path : 'https://via.placeholder.com/150' }}" alt="Backpack 1" class="w-full h-48 object-cover rounded">

                        <h4 class="text-lg font-semibold text-gray-800 mt-4">{{$product->name}}</h4>
                        <p class="text-gray-600">{{$product->description}}</p>
                    </a>
                   @endforeach 
                </div>
            </div>
        </section>

        <section id="contact" class="bg-blue-500 text-white py-16 px-4">
            <div class="container mx-auto text-center">
                <h3 class="text-3xl font-bold mb-4">Get In Touch</h3>
                <p>Contact us for inquiries or collaborations!</p>
                <a href="mailto:info@backpackco.com" class="inline-block bg-white text-blue-500 font-semibold py-3 px-8 mt-6 rounded-full shadow-lg hover:bg-gray-100 transition">Email Us</a>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6">
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
