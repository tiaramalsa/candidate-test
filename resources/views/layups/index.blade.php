<x-app-layout>
    <div class="p-6">

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Layups</h1>

            <a href="{{ route('layups.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Create Layup
            </a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Supplier</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($layups as $layup)
                    <tr>
                        <td class="border p-2">
                            {{ $layup->supplier->name }}
                        </td>

                        <td class="border p-2">
                            {{ $layup->name }}
                        </td>

                        <td class="border p-2">
                            {{ $layup->description }}
                        </td>

                        <td class="border p-2 flex gap-2">

                            <a href="{{ route('layups.edit', $layup) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('layups.destroy', $layup) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>