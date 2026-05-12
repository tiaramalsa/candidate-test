<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Suppliers
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage supplier data and related layups
                </p>
            </div>

            <div class="flex items-center gap-3">

                <span class="bg-blue-100 text-blue-700
                             px-3 py-2 rounded-lg text-sm font-medium">

                    {{ $suppliers->count() }} Suppliers

                </span>

                <a href="{{ route('suppliers.import.form') }}"
                   class="bg-emerald-500 hover:bg-emerald-600
                          text-white px-4 py-2 rounded-lg
                          text-sm font-medium transition">

                    Import JSON

                </a>

                <a href="{{ route('suppliers.create') }}"
                   class="bg-blue-600 hover:bg-blue-700
                          text-white px-4 py-2 rounded-lg
                          text-sm font-medium transition">

                    Create Supplier

                </a>

            </div>

        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Phone
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($suppliers as $supplier)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $supplier->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $supplier->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $supplier->phone }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a href="{{ route('suppliers.export', $supplier) }}"
                                       class="bg-emerald-500 hover:bg-emerald-600
                                              text-white px-3 py-2 rounded-lg
                                              text-sm transition">

                                        Export

                                    </a>

                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                       class="bg-amber-400 hover:bg-amber-500
                                              text-white px-3 py-2 rounded-lg
                                              text-sm transition">

                                        Edit

                                    </a>

                                    <form action="{{ route('suppliers.destroy', $supplier) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this supplier?')"
                                            class="bg-red-500 hover:bg-red-600
                                                   text-white px-3 py-2 rounded-lg
                                                   text-sm transition">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-6 py-10 text-center text-gray-500">

                                No suppliers found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>