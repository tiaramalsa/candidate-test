<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Edit Layup
            </h1>

            <p class="text-gray-500 mt-2">
                Update CLT layup information.
            </p>

        </div>

        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6">

            <form action="{{ route('layups.update', $layup) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Supplier --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Supplier

                    </label>

                    <select name="supplier_id"
                            class="w-full border border-gray-300
                                   rounded-xl p-3">

                        @foreach ($suppliers as $supplier)

                            <option value="{{ $supplier->id }}"
                                {{ $layup->supplier_id == $supplier->id ? 'selected' : '' }}>

                                {{ $supplier->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Name --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Layup Name

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $layup->name) }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3">

                </div>

                {{-- Description --}}
                <div class="mb-8">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Description

                    </label>

                    <textarea name="description"
                              rows="4"
                              class="w-full border border-gray-300
                                     rounded-xl p-3">{{ old('description', $layup->description) }}</textarea>

                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('layups.index') }}"
                       class="px-5 py-3 rounded-xl
                              border border-gray-300
                              text-gray-700 hover:bg-gray-50
                              transition">

                        Cancel

                    </a>

                    <button
                        class="bg-blue-600 hover:bg-blue-700
                               text-white px-5 py-3
                               rounded-xl font-medium
                               transition">

                        Update Layup

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>