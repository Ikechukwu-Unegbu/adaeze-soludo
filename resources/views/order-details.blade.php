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

                    <!-- end creation -->
                    <!-- product management -->
                    <div class="container mx-auto mt-10 px-4">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800">Orders Details</h2>
                        <div class="my-6">
                            <h2 class="text-lg font-medium text-gray-700">Order #{{ $order->order_id }}</h2>
                            <p class="text-sm text-gray-500">Placed on: {{ $order->created_at->format('M d, Y') }}</p>
                            <p class="text-sm text-gray-500">Status: <span
                                    class="text-{{ $order->payment->status ? 'green' : 'red' }}-600 font-medium">{{ $order->payment->status ? 'Confirmed' : 'Failed' }}</span>
                            </p>
                        </div>
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

                        <div class="mt-6 border-b">
                            <div class="flex justify-between py-4">
                                <p class="text-lg font-semibold text-gray-800">Total</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    NGN{{ number_format($order->orderItems->sum('amount', 2)) }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Custom Logo: {{ $order->custom_logo ? 'Yes' : 'No' }}</h3>
                            @if ($order->logo)
                            <a class="mt-4" href="{{ $order->orderLogo }}" target="_blank">
                                <img src="{{ $order->orderLogo }}" width="300" alt="logo">
                            </a>
                            @endif
                        </div>
        
                        <!-- Address Section -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Shipping Address</h3>
                            <p class="text-gray-600">{{ $order->email }}</p>
                            <p class="text-gray-600">{{ $order->address }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <div></div>
                        <a href="{{ route('order.index') }}" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-500">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>