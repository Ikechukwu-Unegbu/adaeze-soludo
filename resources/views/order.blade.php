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
                        <h2 class="text-2xl font-bold mb-6 text-gray-800">Orders</h2>
                        <div class="">

                            <div class="overflow-x-auto">
                                <table id="ordersTable"
                                    class="table-auto border-collapse border border-gray-200 w-full">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border border-gray-300 px-4 py-2 text-left">SN</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Order ID</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Items</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Total Price</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">{{ $loop->index + 1 }}</td>
                                                <td class="border border-gray-300 px-4 py-2">{{ $order->order_id }}</td>
                                                <td class="border border-gray-300 px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    {{ $order->order_items_count }}</td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    {{ $order->orderItems->sum('quantity') }}</td>
                                                <td class="border border-gray-300 px-4 py-2">NGN
                                                    {{ number_format($order->orderItems->sum('amount'), 2) }}</td>
                                                <td
                                                    class="border border-gray-300 px-4 py-2 text-{{ $order->payment->status ? 'green' : 'red' }}-600">
                                                    {{ $order->payment->status ? 'Completed' : 'Failed' }}
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <a href="{{ route('order.show', $order->uuid) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add more cards as needed -->
                        </div>
                    </div>

                    <!-- end product management -->
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @endpush
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#ordersTable').DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    language: {
                        search: "Search orders:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ orders",
                        paginate: {
                            previous: "Prev",
                            next: "Next",
                        },
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>
