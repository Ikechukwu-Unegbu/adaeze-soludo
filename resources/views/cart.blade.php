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
                    <li><a href="/" class="hover:text-gray-800">Home</a></li>
                    <li><a href="{{ route('product.index') }}" class="hover:text-gray-800">Products</a></li>
                    <li><a href="#" class="hover:text-gray-800">Contact</a></li>
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

            <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
                <div class="space-y-6">
                    @forelse($products as $product)
                    <div class="flex items-center justify-between border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $product->image_path ?? 'https://via.placeholder.com/80' }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-gray-600">Price: NGN {{ number_format($product->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="javasript:void(0)" class="decrement-btn text-gray-800 border px-2 py-1 rounded-md" 
                                    data-product-id="{{ $product->id }}" 
                                    data-price="{{ $product->price }}">-</a>
                            <input type="text" 
                                type="text" 
                                name="quantities[{{ $product->id }}]" 
                                value="{{ $cart[$product->id] }}" 
                                min="1" 
                                class="quantity-input w-16 text-center border rounded-md text-gray-800" 
                                data-product-id="{{ $product->id }}" 
                                data-price="{{ $product->price }}" 
                                readonly
                            >
                            <a href="javasript:void(0)"  class="increment-btn text-gray-800 border px-2 py-1 rounded-md" 
                                    data-product-id="{{ $product->id }}" 
                                    data-price="{{ $product->price }}">+</a>
                            <button type="button" 
                                    class="ml-4 text-red-500 hover:text-red-600 remove-item-btn" 
                                    data-product-id="{{ $product->id }}" 
                                    data-product-name="{{ $product->name }}">
                                Remove
                            </button>
                        </div>
                    </div>
                    
                    @empty
                        <p class="text-gray-600">Your cart is empty.</p>
                    @endforelse
                </div>

                @if($products->isNotEmpty())
                    <!-- Total Section -->
                    <div class="mt-8 border-t pt-4">
                        <div class="flex justify-between text-lg font-semibold text-gray-800">
                            <p>Total</p>
                            <p>NGN {{ number_format($products->sum(fn($product) => $product->price * $cart[$product->id]), 2) }}</p>
                        </div>
                        <button type="submit" class="mt-6 w-full bg-blue-500 text-white py-3 rounded-lg shadow-lg hover:bg-blue-600">
                            Proceed to Checkout
                        </button>
                    </div>
                @endif
            </form>

            <form id="remove-item-form" action="" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-16">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Backpack Co. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // const menuBtn = document.getElementById('menu-btn');
        // const mobileMenu = document.getElementById('mobile-menu');

        // menuBtn.addEventListener('click', () => {
        //     mobileMenu.classList.toggle('hidden');
        // });

    document.addEventListener('DOMContentLoaded', () => {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const incrementButtons = document.querySelectorAll('.increment-btn');
        const decrementButtons = document.querySelectorAll('.decrement-btn');
        const totalElement = document.querySelector('div.flex.justify-between.text-lg.font-semibold.text-gray-800 p:last-child');

        // Function to calculate the total
        const calculateTotal = () => {
            let total = 0;
            quantityInputs.forEach(input => {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value, 10) || 0;
                total += price * quantity;
            });
            totalElement.textContent = `NGN ${formatNumber(total.toFixed(2))}`;
        };

        // Event listener for increment buttons
        incrementButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.dataset.productId;
                const input = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
                input.value = parseInt(input.value, 10) + 1;
                calculateTotal();
            });
        });

        // Event listener for decrement buttons
        decrementButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.dataset.productId;
                const input = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
                if (parseInt(input.value, 10) > 1) {
                    input.value = parseInt(input.value, 10) - 1;
                    calculateTotal();
                }
            });
        });

        function formatNumber(number) {
            return new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            }).format(number);
        }

        // Update total on page load
        calculateTotal();
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-item-btn');
    const removeForm = document.getElementById('remove-item-form');

    removeButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const confirmed = confirm(`Are you sure you want to remove this item: ${productName}?`);

            if (confirmed) {
                const baseUrl = "{{ route('cart.delete', ':id') }}"
                const routeUrl = baseUrl.replace(':id', productId);
                removeForm.action = routeUrl;
                removeForm.submit();
            }
        });
    });
});
</script>
</body>
</html>
