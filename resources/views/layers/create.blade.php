<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            Create Layer
        </h1>

        <form action="{{ route('layers.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Layup</label>

                <select name="layup_id"
                        class="w-full border rounded p-2">

                    @foreach ($layups as $layup)
                        <option value="{{ $layup->id }}">
                            {{ $layup->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label>Layer Order</label>

                <input type="number"
                       name="layer_order"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Thickness</label>

                <input type="number"
                       step="0.01"
                       name="thickness"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Width</label>

                <input type="number"
                       step="0.01"
                       name="width"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Angle</label>

                <input type="number"
                       step="0.01"
                       name="angle"
                       class="w-full border rounded p-2">
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>

        </form>

    </div>
</x-app-layout>