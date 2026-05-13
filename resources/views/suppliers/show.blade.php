<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $supplier->name }}
                </h1>

                <p class="text-gray-500 mt-2">
                    Supplier details, layups, and layers hierarchy.
                </p>

            </div>

            <a href="{{ route('suppliers.index') }}"
               class="px-5 py-3 rounded-xl
                      border border-gray-300
                      text-gray-700 hover:bg-gray-50
                      transition">

                Back

            </a>

        </div>

        {{-- Supplier Info --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6 mb-6">

            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Supplier Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Email
                    </p>

                    <p class="font-medium text-gray-800">
                        {{ $supplier->email ?? '-' }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Phone
                    </p>

                    <p class="font-medium text-gray-800">
                        {{ $supplier->phone ?? '-' }}
                    </p>

                </div>

                <div class="md:col-span-2">

                    <p class="text-sm text-gray-500 mb-1">
                        Address
                    </p>

                    <p class="font-medium text-gray-800">
                        {{ $supplier->address ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Layups --}}
        <div class="space-y-6">

            @forelse ($supplier->layups as $layup)

                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-100 overflow-hidden">

                    {{-- Layup Header --}}
                    <div class="px-6 py-5 border-b bg-gray-50">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="text-xl font-semibold text-gray-800">
                                    {{ $layup->name }}
                                </h3>

                                <p class="text-gray-500 text-sm mt-1">
                                    {{ $layup->description ?? 'No description' }}
                                </p>

                            </div>

                            <span class="bg-purple-100 text-purple-700
                                         px-3 py-2 rounded-lg text-sm font-medium">

                                {{ $layup->layers->count() }} Layers

                            </span>

                        </div>

                    </div>

                    {{-- Layers Table --}}
                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm
                                           font-semibold text-gray-600">
                                    Order
                                </th>

                                <th class="px-6 py-4 text-left text-sm
                                           font-semibold text-gray-600">
                                    Thickness
                                </th>

                                <th class="px-6 py-4 text-left text-sm
                                           font-semibold text-gray-600">
                                    Width
                                </th>

                                <th class="px-6 py-4 text-left text-sm
                                           font-semibold text-gray-600">
                                    Angle
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($layup->layers as $layer)

                                <tr class="border-t hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $layer->layer_order }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $layer->thickness }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $layer->width }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $layer->angle }}°
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="px-6 py-6 text-center text-gray-500">

                                        No layers found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-sm
                            border border-gray-100 p-10 text-center
                            text-gray-500">

                    No layups found for this supplier.

                </div>

            @endforelse

        </div>

    </div>

</x-app-layout>