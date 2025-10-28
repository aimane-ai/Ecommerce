<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mt-5">

                        @if($orders->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-lg text-gray-600 dark:text-gray-300">No Orders found.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">#</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Name</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Address</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Product</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Product Name</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Price</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Phone</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Ordered At</th>
                                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @php $id = 1; @endphp
                                        @foreach ($orders as $order)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $id++ }}</td>
                                                <td class="px-4 py-3 text-sm font-medium text-red-600">{{ $order->name }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $order->address }}</td>
                                                <td class="px-4 py-3">
                                                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                                                        alt="{{ $order->product->name }}" 
                                                        class="w-16 h-16 object-cover rounded-lg shadow">
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $order->product->name }}</td>
                                                <td class="px-4 py-3 text-sm font-semibold text-green-600">{{ $order->product->prix }} MAD</td>
                                                <td class="px-4 py-3 text-sm text-red-600">{{ $order->telephone }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="px-4 py-3">
                                                    @if($order->status === 'pending')
                                                        <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                                    @elseif($order->status === 'delivered')
                                                        <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Delivered</span>
                                                    @elseif($order->status === 'canceled')
                                                        <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Canceled</span>
                                                    @else
                                                        <span class="px-3 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div> <!-- end container -->
                </div> <!-- end p-6 -->
            </div> <!-- end card -->
        </div> <!-- end max-w -->
    </div> <!-- end py-12 -->
</x-app-layout>
