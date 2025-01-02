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
                    <li><a href="/" class="hover:text-gray-800">Home</a></li>
                    <li><a href="{{ route('product.index') }}" class="hover:text-gray-800">Products</a></li>
                    <li><a href="#" class="hover:text-gray-800">Contact</a></li>
                </ul>
                <button id="menu-btn" class="block md:hidden text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>
        </div>
        <ul id="mobile-menu" class="hidden flex flex-col space-y-4 px-4 py-6 bg-white shadow-md md:hidden">
            <li><a href="/" class="hover:text-gray-800">Home</a></li>
            <li><a href="{{ route('product.index') }}" class="hover:text-gray-800">Products</a></li>
            <li><a href="#" class="hover:text-gray-800">Contact</a></li>
        </ul>
    </header>

    <main class="py-16 px-4">
        <div class="container mx-auto max-w-4xl bg-white shadow-lg rounded-lg p-6">
            <div class="fixed top-5 right-5 z-50">
                @if (session('success'))
                    <div
                        class="bg-green-500 text-white font-semibold py-2 px-4 rounded-md shadow-lg flex items-center space-x-2">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
            </div>
            <form action="{{ route('checkout.payment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Checkout</h2>
                <div class="">
                    <div class="p-3">
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your email">
                            @error('email') <span class="text-red-600 font-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone_number" value="{{ old('phone_number') }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your phone number">
                                @error('phone_number') <span class="text-red-600 font-bold">{{ $message }}</span> @enderror
                        </div>
                        <label class="block mt-4 text-sm text-gray-700 font-bold">Do you want a custom logo?</label>
                        <select
                            name="custom_logo"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="customLogo">
                            <option value="">----</option>
                            <option value="1" @selected(old('custom_logo') === '1')>Yes</option>
                            <option value="0" @selected(old('custom_logo') === '0')>No</option>
                        </select>
                        @error('custom_logo') <span class="text-red-600 font-bold">{{ $message }}</span> @enderror
                        <div class="mt-4" id="uploadLogoWrapper" style="display: {{ old('custom_logo') === '1' ? 'block' : 'none' }};">
                            <label for="logo-upload" class="block text-gray-700 text-sm font-bold mb-2">Upload Logo</label>
                            <input type="file" id="logo-upload" name="logo" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        @error('logo') <span class="text-red-600 font-bold">{{ $message }}</span> @enderror
                        <div class="mt-4">
                            <div class="mt-4">
                                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Delivery Address</label>
                                <input type="text" id="address" name="address" value="{{ old('address') }}"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Enter your delivery address">
                                    @error('address') <span class="text-red-600 font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                              Proceed
                            </button>
                          </div>
                    </div>
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

    <script>
        document.getElementById('customLogo').addEventListener('change', function () {
            const uploadLogoWrapper = document.getElementById('uploadLogoWrapper');
            if (this.value === '1') {
                uploadLogoWrapper.style.display = 'block';
            } else {
                uploadLogoWrapper.style.display = 'none';
            }
        });
    </script>
</body>

</html>
