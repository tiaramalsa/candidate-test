<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Create Layup
            </h1>

            <p class="text-gray-500 mt-2">
                Add a new CLT layup under a supplier.
            </p>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6">

            <form action="{{ route('layups.store') }}"
                  method="POST">

                @csrf

                {{-- Supplier --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Supplier

                    </label>

                    <select name="supplier_id"
                            class="w-full border border-gray-300
                                   rounded-xl p-3
                                   focus:ring-2 focus:ring-blue-500
                                   focus:border-blue-500">

                        @foreach ($suppliers as $supplier)

                            <option value="{{ $supplier->id }}">

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
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3
                                  focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500">

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
                                     rounded-xl p-3
                                     focus:ring-2 focus:ring-blue-500
                                     focus:border-blue-500">{{ old('description') }}</textarea>

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

                        Save Layup

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>