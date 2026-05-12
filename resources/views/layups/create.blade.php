<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">
            Create Layup
        </h1>

        <form action="{{ route('layups.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Supplier</label>

                <select name="supplier_id"
                        class="w-full border rounded p-2">

                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label>Name</label>

                <input type="text"
                       name="name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Description</label>

                <textarea name="description"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>

        </form>

    </div>
</x-app-layout>