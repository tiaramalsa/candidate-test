<x-app-layout>
    <div class="p-6">

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Layers</h1>

            <a href="{{ route('layers.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Create Layer
            </a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Layup</th>
                    <th class="border p-2">Order</th>
                    <th class="border p-2">Thickness</th>
                    <th class="border p-2">Width</th>
                    <th class="border p-2">Angle</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($layers as $layer)
                    <tr>

                        <td class="border p-2">
                            {{ $layer->layup->name }}
                        </td>

                        <td class="border p-2">
                            {{ $layer->layer_order }}
                        </td>

                        <td class="border p-2">
                            {{ $layer->thickness }}
                        </td>

                        <td class="border p-2">
                            {{ $layer->width }}
                        </td>

                        <td class="border p-2">
                            {{ $layer->angle }}
                        </td>

                        <td class="border p-2 flex gap-2">

                            <a href="{{ route('layers.edit', $layer) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('layers.destroy', $layer) }}"
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