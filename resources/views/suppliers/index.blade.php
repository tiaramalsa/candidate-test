<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Suppliers</h1>

            <a href="{{ route('suppliers.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Create Supplier
            </a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Phone</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td class="border p-2">{{ $supplier->name }}</td>
                        <td class="border p-2">{{ $supplier->email }}</td>
                        <td class="border p-2">{{ $supplier->phone }}</td>

                        <td class="border p-2 flex gap-2">
                            <a href="{{ route('suppliers.edit', $supplier) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('suppliers.destroy', $supplier) }}"
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