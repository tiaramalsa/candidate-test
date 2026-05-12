<x-app-layout>

    <div class="max-w-3xl mx-auto p-6">

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-3xl font-bold text-gray-800">
                Create Supplier
            </h1>

            <p class="text-gray-500 mt-2">
                Add a new supplier and related information.
            </p>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm
                    border border-gray-100 p-6">

            <form action="{{ route('suppliers.store') }}"
                  method="POST">

                @csrf

                {{-- Name --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Supplier Name

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3
                                  focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500">

                </div>

                {{-- Email --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Email Address

                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3
                                  focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500">

                </div>

                {{-- Phone --}}
                <div class="mb-5">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Phone Number

                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           class="w-full border border-gray-300
                                  rounded-xl p-3
                                  focus:ring-2 focus:ring-blue-500
                                  focus:border-blue-500">

                </div>

                {{-- Address --}}
                <div class="mb-8">

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Address

                    </label>

                    <textarea name="address"
                              rows="4"
                              class="w-full border border-gray-300
                                     rounded-xl p-3
                                     focus:ring-2 focus:ring-blue-500
                                     focus:border-blue-500">{{ old('address') }}</textarea>

                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">

                    <a href="{{ route('suppliers.index') }}"
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

                        Save Supplier

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>