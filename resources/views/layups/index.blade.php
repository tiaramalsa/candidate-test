<x-app-layout>

    <div class="max-w-7xl mx-auto p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Layups
                </h1>

                <p class="text-gray-500 mt-1">
                    Manage CLT layups under suppliers
                </p>

            </div>

            <div class="flex items-center gap-3">

                <span class="bg-purple-100 text-purple-700
                             px-3 py-2 rounded-lg text-sm font-medium">

                    {{ $layups->count() }} Layups

                </span>

                <a href="{{ route('layups.create') }}"
                   class="bg-blue-600 hover:bg-blue-700
                          text-white px-4 py-2 rounded-lg
                          text-sm font-medium transition">

                    Create Layup

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
                            Supplier
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Layup Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Description
                        </th>

                        <th class="px-6 py-4 text-left text-sm
                                   font-semibold text-gray-600">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($layups as $layup)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $layup->supplier->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-700">
                                    {{ $layup->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-gray-600">

                                {{ $layup->description ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a href="{{ route('layups.edit', $layup) }}"
                                       class="bg-amber-400 hover:bg-amber-500
                                              text-white px-3 py-2 rounded-lg
                                              text-sm transition">

                                        Edit

                                    </a>

                                    <form action="{{ route('layups.destroy', $layup) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this layup?')"
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

                                No layups found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>