<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Supplier</h1>

        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Name</label>

                <input type="text"
                       name="name"
                       value="{{ $supplier->name }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Email</label>

                <input type="email"
                       name="email"
                       value="{{ $supplier->email }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Phone</label>

                <input type="text"
                       name="phone"
                       value="{{ $supplier->phone }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Address</label>

                <textarea name="address"
                          class="w-full border rounded p-2">{{ $supplier->address }}</textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>