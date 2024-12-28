<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co. - Create Product</title>
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
                    <li><a href="cart.html" class="hover:text-gray-800">Cart</a></li>
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
            <li><a href="cart.html" class="hover:text-gray-800">Cart</a></li>
        </ul>
    </header>

    <main class="py-16 px-4">
        <div class="container mx-auto max-w-2xl bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Product</h2>

            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Product Name</label>
                    <input type="text" id="name" name="name" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product name" required>
                </div>

                <div>
                    <label for="price" class="block text-gray-700 font-medium">Price ($)</label>
                    <input type="number" id="price" name="price" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product price" step="0.01" required>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full mt-2 p-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter product description" required></textarea>
                </div>

                <div>
                    <label for="image" class="block text-gray-700 font-medium">Product Image</label>
                    <input type="file" id="image" name="image" class="w-full mt-2 p-3 border rounded-lg shadow-sm" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-blue-600 transition">Create Product</button>
                </div>
            </form>
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
