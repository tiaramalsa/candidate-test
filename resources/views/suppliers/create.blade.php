<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Create Supplier</h1>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Name</label>
                <input type="text"
                       name="name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Phone</label>
                <input type="text"
                       name="phone"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label>Address</label>
                <textarea name="address"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>