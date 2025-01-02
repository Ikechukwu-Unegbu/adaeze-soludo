<div class="overflow-x-auto">
    <table id="ordersTable" class="table-auto border-collapse border border-gray-200 w-full">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-4 py-2 text-left">SN</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Order ID</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Items</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Quantity</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Total Price</th>
          <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
          {{-- <th class="border border-gray-300 px-4 py-2 text-left">Actions</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->index+1 }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $order->order_id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $order->order_items_count }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $order->orderItems->sum('quantity') }}</td>
            <td class="border border-gray-300 px-4 py-2">NGN {{ number_format($order->orderItems->sum('amount'), 2) }}</td>
            <td class="border border-gray-300 px-4 py-2 text-{{ $order->payment->status ? 'green' : 'red' }}-600">
              {{ $order->payment->status ? 'Completed' : 'Failed' }}
            </td>
            {{-- <td class="border border-gray-300 px-4 py-2">
              <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</button>
            </td> --}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>