<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backpack Co. - Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printable-div,
            #printable-div * {
                visibility: visible;
            }

            #printable-div {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
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
            <li><a href="index.html" class="hover:text-gray-800">Home</a></li>
            <li><a href="products.html" class="hover:text-gray-800">Products</a></li>
            <li><a href="contact.html" class="hover:text-gray-800">Contact</a></li>
        </ul>
    </header>

    <main class="py-16 px-4">
        <div class="container mx-auto max-w-4xl bg-white shadow-lg rounded-lg p-6">
            <div id="printable-div">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Order Summary</h2>
                <!-- Order Details -->
                <div class="my-6">
                    <h2 class="text-lg font-medium text-gray-700">Order #{{ $order->order_id }}</h2>
                    <p class="text-sm text-gray-500">Placed on: {{ $order->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">Status: <span
                            class="text-{{ $order->payment->status ? 'green' : 'red' }}-600 font-medium">{{ $order->payment->status ? 'Confirmed' : 'Failed' }}</span>
                    </p>
                </div>

                <!-- Items Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Items</h3>
                    <div class="border-t">
                        @foreach ($order->orderItems as $item)
                            <!-- Item 1 -->
                            <div class="flex justify-between py-4 border-b">
                                <div>
                                    <p class="text-gray-800 font-medium">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <p class="text-gray-800 font-medium">{{ number_format($item->amount, 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Section -->
                <div class="mt-6">
                    <div class="flex justify-between py-4">
                        <p class="text-lg font-semibold text-gray-800">Total</p>
                        <p class="text-lg font-semibold text-gray-800">
                            NGN{{ number_format($order->orderItems->sum('amount', 2)) }}</p>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Shipping Address</h3>
                    <p class="text-gray-600">{{ $order->email }}</p>
                    <p class="text-gray-600">{{ $order->address }}</p>
                </div>
            </div>

            <!-- Actions Section -->
            <div class="mt-6 flex justify-between">
                <div></div>
                <button onclick="printDiv()"
                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-500">Download
                    Invoice</button>
            </div>
        </div>

    </main>

    <script>
        function printDiv() {
            var printableDiv = document.getElementById('printable-div');
            window.print();
        }
    </script>

</body>
