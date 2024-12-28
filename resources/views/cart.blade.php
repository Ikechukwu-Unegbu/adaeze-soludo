<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co. - Cart</title>
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
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Cart</h2>

            <div class="space-y-6">
                <!-- Cart Item 1 -->
                <div class="flex items-center justify-between border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80" alt="Product Image" class="w-20 h-20 object-cover rounded">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Adventure Backpack</h3>
                            <p class="text-gray-600">Price: $79.99</p>
                        </div>
                    </div>
                    <div>
                        <input type="number" value="1" class="w-16 text-center border rounded-md text-gray-800">
                        <button class="ml-4 text-red-500 hover:text-red-600">Remove</button>
                    </div>
                </div>

                <!-- Cart Item 2 -->
                <div class="flex items-center justify-between border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80" alt="Product Image" class="w-20 h-20 object-cover rounded">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Urban Backpack</h3>
                            <p class="text-gray-600">Price: $69.99</p>
                        </div>
                    </div>
                    <div>
                        <input type="number" value="1" class="w-16 text-center border rounded-md text-gray-800">
                        <button class="ml-4 text-red-500 hover:text-red-600">Remove</button>
                    </div>
                </div>
            </div>

            <!-- Total Section -->
            <div class="mt-8 border-t pt-4">
                <div class="flex justify-between text-lg font-semibold text-gray-800">
                    <p>Total</p>
                    <p>$149.98</p>
                </div>
                <button class="mt-6 w-full bg-blue-500 text-white py-3 rounded-lg shadow-lg hover:bg-blue-600">
                    Proceed to Checkout
                </button>
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